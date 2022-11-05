<?php

namespace App\Models\Traits;

/**
 * @property-read string|null $tags_string
 */
trait Tags
{
    use Resources;

    /**
     * @return string|null
     */
    public function getTagsStringAttribute(): ?string
    {
        return $this->getResourcesString('tags');
    }
}
