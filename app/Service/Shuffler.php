<?php

namespace App\Service;

use Exception;
use App\Models\Log;
use App\Models\Card;
use App\Models\Stack;

class Shuffler
{
    const CARD_PLACE_TOP = 0;
    const CARD_PLACE_BOTTOM = 1;
    const CARD_PLACE_RANDOM = 2;

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

    /**
     * @param Stack $stack
     * @return Log|null
     * @throws Exception
     */
    public static function pull(Stack $stack): ?Log
    {
        $pack = $stack->pack;
        if (empty($pack)) {
            return null;
        }
        $id =  array_shift($pack);
        /** @var Card $card */
        $card = Card::findOrFail($id);

        $stack->pack = $pack;
        $discard = (array) $stack->discard;
        array_unshift($discard, $id);
        $stack->discard = $discard;
        $stack->save();

        $log = new Log();
        $log->game_id = $stack->game_id;
        $log->stack_id = $stack->getKey();
        $log->card_id = $card->getKey();
        $log->save();

        return $log;
    }

    /**
     * @param Stack $stack
     * @param Card $card
     * @param bool $toDiscard
     * @param int $cardPlace
     * @return Stack
     * @throws Exception
     */
    public static function push(
        Stack $stack,
        Card $card,
        bool $toDiscard = true,
        int $cardPlace = self::CARD_PLACE_TOP): Stack
    {
        if (!$id = $card->getKey()) {
            throw new Exception('Card doesnt have primary key!');
        }
        $part = $toDiscard ? 'discard' : 'pack';
        $ids = (array) $stack->$part;
        switch ($cardPlace) {
            case self::CARD_PLACE_TOP:
                array_unshift($ids, $id);
                break;
            case self::CARD_PLACE_BOTTOM:
                $ids[] = $id;
                break;
            case self::CARD_PLACE_RANDOM:
                array_splice($ids, array_rand($ids) + 1, 0, $id);
                break;
            default:
                throw new Exception('Invalid card place');
        }
        $stack->$part = $ids;

        return $stack;
    }
}
