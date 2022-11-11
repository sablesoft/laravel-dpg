<?php

namespace App\Models\Traits;

/**
 * @property-read string|null $decks_string
 * @property-read int|null $decks_count
 */
trait Decks
{
    use Resources;

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
