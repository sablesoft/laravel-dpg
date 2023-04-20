<?php

namespace App\Models\Guide;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

/**
 * @property-read Tag[]|Collection $tags
 */
trait HasTags
{
    /**
     * @return HasMany
     */
    public function tags(): HasMany
    {
        $foreignKey = get_class($this) === User::class ? 'owner_id' : null;
        return $this->hasMany(Tag::class, $foreignKey);
    }
}
