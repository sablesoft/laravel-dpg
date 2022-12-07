<?php

namespace App\Models\Traits;

use App\Models\Card;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read Card[]|null $cards
 *
 * @property-read int|null $cards_count
 */
trait Cards
{
    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'card_relation')
            ->withPivot('count');
    }

    /**
     * @return int|null
     */
    public function getCardsCountAttribute(): ?int
    {
        return $this->cards()->count() ?: null;
    }
}
