<?php

namespace App\Models\Traits;

/**
 * @property-read string|null $adventures_string
 */
trait Adventures
{
    use Resources;

    /**
     * @return string|null
     */
    public function getAdventuresStringAttribute(): ?string
    {
        return $this->getResourcesString('adventures');
    }
}
