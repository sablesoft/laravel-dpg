<?php

namespace App\Models\Traits;

use App\Models\Scene;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read Scene[]|null $scenes
 *
 * @property-read int|null $scenes_count
 */
trait Scenes
{
    /**
     * @return BelongsToMany
     */
    public function scenes(): BelongsToMany
    {
        return $this->belongsToMany(Scene::class, 'scene_relation');
    }

    /**
     * @return int|null
     */
    public function getScenesCountAttribute(): ?int
    {
        return $this->scenes()->count() ?: null;
    }
}
