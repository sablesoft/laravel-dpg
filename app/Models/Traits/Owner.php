<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method Builder hasOwner(User $owner, string $boolean = 'and')
 */
trait Owner
{
    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isOwnedBy(User $user): bool
    {
        return $this->owner_id === $user->getKey();
    }

    /**
     * @param Builder $query
     * @param User $owner
     * @param string $boolean
     * @return Builder
     */
    public function scopeHasOwner(Builder $query, User $owner, string $boolean = 'and'): Builder
    {
        return $query->where('owner_id', '=', $owner->getKey(), $boolean);
    }
}
