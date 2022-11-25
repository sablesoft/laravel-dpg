<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

/**
 * @property-read User[]|null $subscribers
 *
 * @method Builder allowedToSee() static
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
     * @param Builder $query
     * @return Builder
     */
    public function scopeAllowedToSee(Builder $query): Builder
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->isAdmin()) {
            return $query;
        }

        $query->where('is_public', true)
            ->orWhere(function($query) use ($user) {
                return $query->whereHas('subscribers', function($query) use ($user) {
                    $query->where('subscriber_id', $user->getKey());
                });
            });

        return $query;
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
