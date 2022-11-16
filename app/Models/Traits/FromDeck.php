<?php

namespace App\Models\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use App\Models\Set;
use App\Models\Deck;
use App\Models\Game;

/**
 * @mixin Set
 */
trait FromDeck
{
    /**
     * @param Game $game
     * @param Deck $deck
     * @param int $type
     * @return Model
     * @throws Exception
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    protected static function prepareFromDeck(Game $game, Deck $deck, int $type): Model
    {
        if (!$deck->getKey() || !$game->getKey()) {
            throw new Exception('Game and deck must be saved first!');
        }
        if ($deck->type !== $type) {
            throw new Exception('Invalid Deck type!');
        }

        $model = new static();
        $model->game_id = $game->getKey();
        $model->deck_id = $deck->getKey();
        $model->card_id = $deck->card_id;
        $model->scope_id = $deck->scope_id;
        $model->desc = $deck->desc;

        return $model;
    }
}
