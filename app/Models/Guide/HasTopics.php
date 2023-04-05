<?php

namespace App\Models\Guide;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

/**
 * @property-read Topic[]|Collection $topics
 */
trait HasTopics
{
    /**
     * @return HasMany
     */
    public function topics(): HasMany
    {
        $foreignKey = get_class($this) === User::class ? 'owner_id' : null;
        return $this->hasMany(Topic::class, $foreignKey);
    }
}
