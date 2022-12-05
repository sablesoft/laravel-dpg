<?php

namespace App\Service;

use App\Models\Book;
use App\Models\Card;
use App\Models\Game;

class BoardService
{
    /**
     * @param Game $game
     * @return array
     */
    public static function gameToArray(Game $game): array
    {
        $game->makeHidden(['id', 'book_id', 'master_id', 'created_at', 'updated_at']);
        $data = $game->toArray();
        $data['scope_name'] = __('Game');
//        $data['book'] = static::bookToArray($game->book);

        return $data;
    }

    /**
     * @param Book $book
     * @return array
     */
    public static function bookToArray(Book $book): array
    {
        $book->makeHidden(['id', 'scope_id', 'owner_id', 'is_public', 'created_at', 'updated_at']);
        $data = $book->toArray();
        $collection = [];
        foreach ($book->cards as $card) {
            $collection[$card->getKey()] = static::cardToArray($card);
        }
        $data['collection'] = $collection;

        return $data;
    }

    /**
     * @param Card $card
     * @return array
     */
    public static function cardToArray(Card $card): array
    {
        $card->makeHidden(['is_public', 'owner_id', 'created_at', 'updated_at', 'pivot']);
        $data = $card->toArray();
        $scopeName = optional($card->scope)->getRawOriginal('name');
        $scopeName = $scopeName ? json_decode($scopeName, true) : null;
        $data['scope_name'] = $scopeName;

        return $data;
    }
}
