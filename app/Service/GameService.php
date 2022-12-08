<?php

namespace App\Service;

use App\Models\Book;
use App\Models\Card;
use App\Models\Deck;
use App\Models\Dome;
use App\Models\Game;
use Illuminate\Support\Facades\App;

class GameService
{
    /**
     * @param Game $game
     * @param string|null $locale
     * @return array
     */
    public static function gameToArray(Game $game, ?string $locale = null): array
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $game->makeHidden(['owner_id', 'quest_id', 'created_at', 'updated_at']);
        $data = self::translate($game->toArray(), $game->translatable, $locale);
        $data['image'] = self::image($data['image']);
        $data['scope_name'] = __('Game');
        $data['quest'] = static::cardToArray($game->quest, $locale);
        foreach ($game->heroes as $hero) {
            $data['heroes'][$hero->getKey()] = static::cardToArray($hero, $locale);
        }
        $books = [];
        $domes = [];
        foreach ($game->books as $book) {
            static::bookToArray($books, $domes, $book, $locale);
        }
        $data['books'] = $books;
        $data['domes'] = $domes;

        return $data;
    }

    /**
     * @param array $books
     * @param array $domes
     * @param Book $book
     * @param string|null $locale
     * @return void
     */
    public static function bookToArray(array &$books, array &$domes, Book $book, ?string $locale = null)
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $book->makeHidden(['scope_id', 'owner_id', 'is_public', 'created_at', 'updated_at', 'pivot']);
        $data = self::translate($book->toArray(), $book->translatable, $locale);
        $data['image'] = self::image($data['image']);
        $sourcesIds = [];
        foreach ($book->sources as $source) {
            $sourcesIds[] = $source->getKey();
            if (empty($books[$source->getKey()])) {
                static::bookToArray($books, $domes, $source, $locale);
            }
        }
        $data['sources'] = $sourcesIds;
        $domesIds = [];
        foreach ($book->domes as $dome) {
            $domesIds[] = $dome->getKey();
            if (empty($domes[$dome->getKey()])) {
                static::domeToArray($domes, $dome, $locale);
            }
        }
        $data['domes'] = $domesIds;
        $collection = [];
        foreach ($book->cards as $card) {
            $collection[$card->getKey()] = static::cardToArray($card, $locale);
        }
        $data['collection'] = $collection;
        $decks = [];
        foreach ($book->decks as $deck) {
            static::deckToArray($decks, $deck, $locale);
        }
        $data['decks'] = $decks;

        $books[$book->getKey()] = $data;
    }

    /**
     * @param array $domes
     * @param Dome $dome
     * @param $locale
     * @return void
     */
    public static function domeToArray(array &$domes, Dome $dome, $locale)
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $dome->makeHidden([
            'code',
            'area_mask',
            'is_public',
            'owner_id',
            'pivot',
            'created_at',
            'updated_at'
        ]);
        $data = self::translate($dome->toArray(), $dome->translatable, $locale);
        $data['image'] = self::image($data['image']);
        $collection = [];
        foreach ($dome->cards as $card) {
            $collection[$card->getKey()] = static::cardToArray($card, $locale);
        }
        $data['collection'] = $collection;
        $decks = [];
        foreach ($dome->decks as $deck) {
            static::deckToArray($decks, $deck, $locale);
        }
        $data['decks'] = $decks;
        $domes[$dome->scope_id] = $data;
    }

    /**
     * @param array $decks
     * @param Deck $deck
     * @param $locale
     * @return void
     */
    public static function deckToArray(array &$decks, Deck $deck, $locale)
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $deck->makeHidden([
            'is_public',
            'owner_id',
            'created_at',
            'updated_at'
        ]);
        $data = self::translate($deck->toArray(), $deck->translatable, $locale);
        $data['image'] = self::image($data['image']);
        $data['target'] = self::cardToArray($deck->target, $locale);
        $data['scope'] = self::cardToArray($deck->scope, $locale);
        $cards = [];
        foreach ($deck->cards as $card) {
            $cards[$card->getKey()] = self::cardToArray($card, $locale);
            $cards[$card->getKey()]['count'] = $card->pivot->count;
        }
        $data['cards'] = $cards;

        $decks[$deck->getKey()] = $data;
    }

    /**
     * @param Card $card
     * @param string|null $locale
     * @return array
     */
    public static function cardToArray(Card $card, ?string $locale = null): array
    {
        if (!$locale) {
            $locale = App::currentLocale();
        }
        $card->makeHidden(['is_public', 'owner_id', 'created_at', 'updated_at', 'pivot']);
        $data = $card->toArray();
        $data['image'] = self::image($data['image']);
        $scopeName = optional($card->scope)->getRawOriginal('name');
        $scopeName = $scopeName ? json_decode($scopeName, true) : null;
        $data['scope_name'] = $scopeName;
        $data['scope_image'] = self::image(optional($card->scope)->image);
        $fields = $card->translatable;
        $fields[] = 'scope_name';

        return self::translate($data, $fields, $locale);
    }

    /**
     * @param array $data
     * @param array $fields
     * @param string $locale
     * @return array
     */
    protected static function translate(array $data, array $fields, string $locale): array
    {
        $fallback = config('app.fallback_locale');
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                continue;
            }
            if (empty($data[$field][$locale])) {
                if (empty($data[$field][$fallback])) {
                    $data[$field] = null;
                    continue;
                }
                $data[$field] = $data[$field][$fallback];
            } else {
                $data[$field] = $data[$field][$locale];
            }
        }

        return $data;
    }

    /**
     * @param string|null $path
     * @return string|null
     */
    protected static function image(?string $path): ?string
    {
        return $path ? '/storage/'.$path : null;
    }
}
