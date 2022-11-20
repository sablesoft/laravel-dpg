<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string|null $cards_back
 * @property-read Card[]|null $cards
 * @property-read Deck[]|null $decks
 *
 * @property-read int|null $cards_count
 */
class Book extends Content
{
    /**
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'book_card');
    }

    /**
     * @return int|null
     */
    public function getCardsCountAttribute(): ?int
    {
        return $this->cards()->count() ?: null;
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
}
