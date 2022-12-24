<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

/**
 * @property-read User[]|null $subscribers
 */
trait Subscribers
{
    /**
     * @param string $key
     * @return BelongsToMany
     */
    protected function _subscribers(string $key): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            "${key}_subscriber",
            "${key}_id",
            'subscriber_id'
        )->withPivot(['type']);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function canBeVisitedBy(User $user): bool
    {
        return $user->isAdmin() ||
            $this->is_public ||
            $this->isOwnedBy($user) ||
            $this->hasSubscriber($user);
    }

    /**
     * @param Builder $query
     * @param User|null $user
     * @return Builder
     */
    public function scopeAllowedToSee(Builder $query, ?User $user = null): Builder
    {
        /** @var User $user */
        $user = $user ?: Auth::user();
        if ($user->isAdmin()) {
            return $query;
        }

        return $query->where(function(Builder $query) use ($user) {
            return $query->where('is_public', true)
                ->orWhere('owner_id', $user->getKey())
                ->orWhere(function($query) use ($user) {
                    return $query->whereHas('subscribers', function($query) use ($user) {
                        $query->where('subscriber_id', $user->getKey());
                    });
                });
        });
    }

    /**
     * @param Builder $query
     * @param User|null $user
     * @return Builder
     */
    public static function staticAllowedToSee(Builder $query, ?User $user = null): Builder
    {
        /** @var User $user */
        $user = $user ?: Auth::user();
        if ($user->isAdmin()) {
            return $query;
        }

        return $query->where(function(Builder $query) use ($user) {
            return $query->where('is_public', true)
                ->orWhere('owner_id', $user->getKey())
                ->orWhere(function($query) use ($user) {
                    return $query->whereHas('subscribers', function($query) use ($user) {
                        $query->where('subscriber_id', $user->getKey());
                    });
                });
        });
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasSubscriber(User $user): bool
    {
        return $this->subscribers()
            ->where('subscriber_id', $user->getKey())
            ->exists();
    }
}
