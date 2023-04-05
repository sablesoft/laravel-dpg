<?php

namespace App\Models\Guide;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

/**
 * @property-read Note[]|Collection $notes
 */
trait HasNotes
{
    /**
     * @return HasMany
     */
    public function notes(): HasMany
    {
        $foreignKey = get_class($this) === User::class ? 'owner_id' : null;
        return $this->hasMany(Note::class, $foreignKey);
    }
}
