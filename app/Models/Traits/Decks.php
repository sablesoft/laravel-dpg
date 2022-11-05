<?php

namespace App\Models\Traits;

/**
 * @property-read string|null $decks_string
 */
trait Decks
{
    use Resources;

    /**
     * @return string|null
     */
    public function getDecksStringAttribute(): ?string
    {
        return $this->getResourcesString('decks');
    }
}
