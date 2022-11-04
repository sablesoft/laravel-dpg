<?php

namespace App\Models\Traits;

/**
 * @property-read string|null $decks_string
 */
trait Decks
{
    public function getDecksStringAttribute(): ?string
    {
        $names = $this->decks()->select('name')
            ->pluck('name')->toArray();

        return $names ? implode(', ', $names) : null;
    }
}
