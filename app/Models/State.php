<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\Owner;
use App\Models\Traits\FromDeck;

/**
 * @property int|null $state_id
 *
 * @property-read string|null $state_image
 *
 * @property-read Card|null $state
 */
class State extends Model
{
    use FromDeck, Owner;

    /**
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'state_id');
    }

    /**
     * @return string|null
     */
    public function getStateImageAttribute(): ?string
    {
        return optional($this->state)->image;
    }

    /**
     * @param Game $game
     * @param Deck $deck
     * @return static
     * @throws Exception
     */
    public static function createFromDeck(Game $game, Deck $deck): static
    {
        /** @var State $state */
        $state = static::prepareFromDeck($game, $deck, Deck::TYPE_STATE);
        /** @var Card $card */
        $card = $deck->cards()->first();
        $state->state_id = $card?->getKey();
        $state->save();

        return $state;
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function (State $state) {
            $state->owner()->associate(Auth::user());
        });
    }
}
