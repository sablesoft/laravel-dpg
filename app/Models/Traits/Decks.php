<?php

namespace App\Models\Traits;

use App\Models\Deck;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read Decks[]|null $decks
 *
 * @property-read string|null $decks_string
 * @property-read int|null $decks_count
 */
trait Decks
{
    use Resources;

    /**
     * @return HasMany
     */
    public function decks(): HasMany
    {
        return $this->hasMany(Deck::class);
    }

    /**
     * @return string|null
     */
    public function getDecksStringAttribute(): ?string
    {
        return $this->getResourcesString('decks', 'units');
    }

    /**
     * @return int|null
     */
    public function getDecksCountAttribute(): ?int
    {
        return $this->decks()->count() ?: null;
    }
}
