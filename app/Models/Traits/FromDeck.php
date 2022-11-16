<?php

namespace App\Models\Traits;

use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Card;
use App\Models\Deck;
use App\Models\Game;

/**
 * @property int|null $id
 * @property int|null $game_id
 * @property int|null $deck_id
 * @property int|null $card_id
 * @property int|null $scope_id
 * @property string|null $desc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read string|null $name
 *
 * @property-read Game|null $game
 * @property-read Deck|null $deck
 * @property-read Card|null $target
 * @property-read Card|null $scope
 */
trait FromDeck
{
    /**
     * @return string|null
     */
    public function getNameAttribute(): ?string
    {
        $target = optional($this->target)->name;
        $scope = optional($this->scope)->name;

        return ($target && $scope) ?
            $target .' - '. $scope : null;
    }

    /**
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return BelongsTo
     */
    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }

    /**
     * @return BelongsTo
     */
    public function target(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    /**
     * @return BelongsTo
     */
    public function scope(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'scope_id');
    }

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
