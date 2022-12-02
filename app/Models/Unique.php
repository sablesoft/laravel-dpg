<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\Owner;
use App\Models\Traits\FromDeck;

/**
 * @property int|null $unique_id
 *
 * @property-read string|null $unique_image
 *
 * @property-read Card|null $unique
 */
class Unique extends Model
{
    use FromDeck, Owner;

    /**
     * @return BelongsTo
     */
    public function unique(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'unique_id');
    }

    /**
     * @return string|null
     */
    public function getUniqueImageAttribute(): ?string
    {
        return optional($this->unique)->image;
    }

    /**
     * @param Game $game
     * @param Deck $deck
     * @return static
     * @throws Exception
     */
    public static function createFromDeck(Game $game, Deck $deck): static
    {
        /** @var Unique $unique */
        $unique = static::prepareFromDeck($game, $deck, Deck::TYPE_UNIQUE);
        /** @var Card $card */
        $card = $deck->cards()->first();
        $unique->unique_id = $card?->getKey();
        $unique->save();

        return $unique;
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function (Unique $unique) {
            $unique->owner()->associate(Auth::user());
        });
    }
}
