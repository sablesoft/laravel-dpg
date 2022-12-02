<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Unique;

class UniquePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user): bool
    {
        return true;
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Unique $unique
     * @return mixed
     */
    public function view(User $user, Unique $unique): bool
    {
        return $user->isAdmin() || $unique->isOwnedBy($user);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param Unique $unique
     * @return bool
     */
    public function update(User $user, Unique $unique): bool
    {
        return $user->isAdmin() || $unique->isOwnedBy($user);
    }

    /**
     * @param User $user
     * @param Unique $unique
     * @return bool
     */
    public function delete(User $user, Unique $unique): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param Unique $unique
     * @return bool
     */
    public function restore(User $user, Unique $unique): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param Unique $unique
     * @return bool
     */
    public function forceDelete(User $user, Unique $unique): bool
    {
        return false;
    }
}
