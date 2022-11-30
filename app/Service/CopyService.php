<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Deck;
use App\Models\Book;
use App\Models\Card;
use App\Exceptions\CopyException;
use App\Exceptions\ImageException;

class CopyService
{
    const CONFIG_USER = 'user';
    const CONFIG_BOOK_ID = 'book_id';
    const CONFIG_COPY_CARDS = 'copy_cards';
    const CONFIG_COPY_DECKS = 'copy_decks';

    const NAME_POSTFIX = ' - COPY';

    /**
     * @param Card $source
     * @param array $config
     * @return Card
     * @throws CopyException|ImageException
     */
    public static function copyCard(Card $source, array $config): Card
    {
        /** @var User $user */
        $user = static::get(self::CONFIG_USER, $config, Auth::user());
        $bookId = static::get(self::CONFIG_BOOK_ID, $config);

        $filename = ImageService::copyImage($source->image);
        $card = $source->replicate();
        $card->image = $filename;
        $card->created_at = Carbon::now();
        $card->is_public = false;
        $card->owner_id = $user->getKey();
        $card->name = $card->name . static::NAME_POSTFIX;

        if (!$card->save()) {
            throw new CopyException('Copy card save error');
        }
        if ($bookId) {
            $card->books()->attach($bookId);
        }

        return $card;
    }

    /**
     * @param Deck $source
     * @param array|null $processedCards
     * @param array|null $config
     * @return Deck
     * @throws CopyException
     * @throws ImageException
     */
    public static function copyDeck(
        Deck $source,
        ?array &$processedCards = [],
        ?array $config = []): Deck
    {
        /** @var User $user */
        $user = static::get(self::CONFIG_USER, $config, Auth::user());
        $bookId = static::get(self::CONFIG_BOOK_ID, $config);
        $copyCards = static::get(self::CONFIG_COPY_CARDS, $config);

        $cardId = array_key_exists($source->card_id, $processedCards) ?
            $processedCards[$source->card_id] : $source->card_id;
        $scopeId = array_key_exists($source->scope_id, $processedCards) ?
            $processedCards[$source->scope_id] : $source->scope_id;
        $exists = Deck::query()->where('book_id', $bookId)
            ->where('card_id', $cardId)
            ->where('scope_id', $scopeId)->exists();
        if ($exists) {
            throw new CopyException('This deck already exists in this book');
        }

        $deck = $source->replicate();
        $deck->book_id = $bookId;
        $deck->owner_id = $user->getKey();
        $deck->created_at = Carbon::now();
        $deck->is_public = false;
        $deck->image = ImageService::copyImage($source->image);

        if ($copyCards) {
            if (!array_key_exists($source->card_id, $processedCards)) {
                $target = CopyService::copyCard($source->target, $config);
                $deck->card_id = $target->getKey();
                $processedCards[$source->card_id] = $deck->card_id;
            } else {
                $deck->card_id = $processedCards[$source->card_id];
            }
            if (!array_key_exists($source->scope_id, $processedCards)) {
                $scope = CopyService::copyCard($source->scope, $config);
                $deck->scope_id = $scope->getKey();
                $processedCards[$source->scope_id] = $deck->scope_id;
            } else {
                $deck->scope_id = $processedCards[$source->scope_id];
            }
        }
        $deck->save();

        foreach ($source->cards as $card) {
            $cardId = $card->getKey();
            if ($copyCards) {
                if (!array_key_exists($cardId, $processedCards)) {
                    $copy = CopyService::copyCard($card, $config);
                    $processedCards[$cardId] = $copy->getKey();
                    $cardId = $copy->getKey();
                } else {
                    $cardId = $processedCards[$cardId];
                }
            }
            $deck->cards()->attach($cardId);
        }

        return $deck;
    }

    /**
     * @param Book $source
     * @param array|null $processedCards
     * @param array|null $config
     * @return Book
     * @throws CopyException
     * @throws ImageException
     */
    public static function copyBook(
        Book $source,
        ?array &$processedCards = [],
        ?array $config = []): Book
    {
        /** @var User $user */
        $user = static::get(self::CONFIG_USER, $config, Auth::user());
        $bookId = static::get(self::CONFIG_BOOK_ID, $config);
        $copyCards = static::get(self::CONFIG_COPY_CARDS, $config);
        $copyDecks = static::get(self::CONFIG_COPY_DECKS, $config);

        if ($bookId) {
            if (!$book = Book::find($bookId)) {
                throw new CopyException('Target book not found!');
            }
        } else {
            $book = $source->replicate();
            $book->is_public = false;
            $book->name = $book->name . static::NAME_POSTFIX;
            $book->image = ImageService::copyImage($book->image);
            $book->cards_back = ImageService::copyImage($book->cards_back);
            $book->owner_id = $user->getKey();
            $book->created_at = Carbon::now();
            $book->save();
            $config[self::CONFIG_BOOK_ID] = $book->getKey();
        }

        foreach ($source->cards as $card) {
            if (array_key_exists($card->getKey(), $processedCards)) {
                continue;
            }
            if ($copyCards) {
                $copy = CopyService::copyCard($card, $config);
                $processedCards[$card->getKey()] = $copy->getKey();
            } else {
                $book->cards()->attach($card);
            }
        }

        // fix copied cards scopes:
        if ($copyCards) {
            /** @var Card $card */
            foreach ($book->cards()->get() as $card) {
                if (array_key_exists($card->scope_id, $processedCards)) {
                    $card->scope_id = $processedCards[$card->scope_id];
                    $card->save();
                }
            }
        }

        if ($copyDecks) {
            foreach ($source->decks as $deck) {
                if (!$deck->hasFullAccess($user)) {
                    throw new CopyException("You don't have full access to all its cards.");
                }
                CopyService::copyDeck($deck, $processedCards, $config);
            }
        }

        return $book;
    }

    /**
     * @param string $key
     * @param array $config
     * @param $default
     * @return mixed|null
     */
    protected static function get(string $key, array $config, $default = null): mixed
    {
        return array_key_exists($key, $config) ? $config[$key]: $default;
    }
}
