<?php

namespace App\Models\Traits;

/**
 * @property-read string|null $tags_string
 */
trait Tags
{
    public function getTagsStringAttribute(): ?string
    {
        $names = $this->tags()->select('name')
            ->pluck('name')->toArray();

        return $names ? implode(', ', $names) : null;
    }
}
