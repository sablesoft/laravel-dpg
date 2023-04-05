<?php

namespace App\Models\Guide;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

/**
 * @property Link[]|Collection $links
 */
trait HasLinks
{
    /**
     * @return HasMany
     */
    public function links(): HasMany
    {
        $foreignKey = get_class($this) === User::class ? 'owner_id' : null;
        return $this->hasMany(Link::class, $foreignKey);
    }
}
