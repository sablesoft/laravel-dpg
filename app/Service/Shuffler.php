<?php

namespace App\Service;

use App\Models\Card;
use App\Models\Stack;

class Shuffler
{
    /**
     * @param Stack $stack
     * @param string|null $part
     * @return Stack
     */
    public static function shuffle(Stack $stack, string $part = null): Stack
    {
        if ($part && !empty($stack->$part)) {
            $cards = $stack->$part;
            shuffle($cards);
            $stack->$part = $cards;
        } else {
            $cards = array_merge((array) $stack->pack, (array) $stack->discard);
            shuffle($cards);
            $stack->pack = $cards;
            $stack->discard = [];
        }

        return $stack;
    }

    /**
     * @param Stack $stack
     * @return Stack
     */
    public static function init(Stack $stack): Stack
    {
        $stack->pack = [];
        $stack->discard = [];
        $cards = optional($stack->deck)->cards;
        if (!$cards) {
            return $stack;
        }
        $ids = [];
        /** @var Card $card */
        foreach ($cards as $card) {
            /** @var int $count */
            $count = $card->pivot->count;
            do {
                $ids[] = $card->getKey();
            } while (--$count);
        }
        $stack->pack = $ids;

        return static::shuffle($stack);
    }
}
