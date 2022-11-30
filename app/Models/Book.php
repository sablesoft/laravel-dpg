<?php

namespace App\Models;

use App\Service\CopyService;
use App\Service\ImageService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;
use App\Models\Traits\Subscribers;

/**
 * @property string|null $cards_back
 * @property-read Card[]|null $cards
 * @property-read Deck[]|null $decks
 *
 * @property-read int|null $cards_count
 *
 */
class Book extends Content
{
    use HasTranslations, Subscribers;

    const SUBSCRIBER_TYPE_PUBLIC = 0;
    const SUBSCRIBER_TYPE_LICENCE = 1;

    /**
     * @var array|string[]
     */
    public array $translatable = ['name', 'desc'];

    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'book_card');
    }

    /**
     * @return BelongsToMany
     */
    public function subscribers(): BelongsToMany
    {
        return $this->_subscribers('book');
    }

    /**
     * @return int|null
     */
    public function getCardsCountAttribute(): ?int
    {
        return $this->cards()->count() ?: null;
    }

    public function makeCopy(
        User $user,
        ?string &$error,
        ?int $bookId = null,
        bool $copyDecks = false,
        bool $copyCards = false,
        array &$processedCards = []
    ): ?Book {
        if ($bookId) {
            if (!$book = static::find($bookId)) {
                $error = __('Target book not found!');
                return null;
            }
        } else {
            $book = $this->replicate();
            $book->is_public = false;
            $book->name = $book->name . ' COPY';
            $book->image = ImageService::copyImage($book->image);
            $book->cards_back = ImageService::copyImage($book->cards_back);
            $book->owner_id = $user->getKey();
            $book->created_at = Carbon::now();
            $book->save();
            $bookId = $book->getKey();
        }
        foreach ($this->cards as $card) {
            if (array_key_exists($card->getKey(), $processedCards)) {
                continue;
            }
            if ($copyCards) {
                $copy = CopyService::copyCard($card, ['book_id' => $bookId, 'user' => $user]);
                $processedCards[$card->getKey()] = $copy->getKey();
            } else {
                $book->cards()->attach($card);
            }
        }
        // fix scopes:
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
            foreach ($this->decks as $deck) {
                if (!$deck->hasFullAccess($user)) {
                    $error = __("You cannot copy one of decks. You don't have full access to all its cards.");
                    return null;
                }
                if (!$deck->makeCopy($user, $error, $book->getKey(), $copyCards, $processedCards)) {
                    return null;
                }
            }
        }

        return $book;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasFullAccess(User $user): bool
    {
        /** @var Card $card */
        foreach ($this->cards as $card) {
            if (!$card->hasFullAccess($user)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return HasMany
     */
    public function decks(): HasMany
    {
        return $this->hasMany(Deck::class);
    }

    /**
     * @return array
     */
    public function export(): array
    {
        $data = parent::export();
        $data['cards'] = $this->cards()->get()->pluck('name')->toArray();

        return $data;
    }

    /**
     * @return array
     */
    public static function subscriberTypeOptions(): array
    {
        return [
            self::SUBSCRIBER_TYPE_PUBLIC => __('Public'),
            self::SUBSCRIBER_TYPE_LICENCE => __('Licence'),
        ];
    }
}
