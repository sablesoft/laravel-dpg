<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\State;

class StatePolicy
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
     * @param State $state
     * @return mixed
     */
    public function view(User $user, State $state): bool
    {
        return $user->isAdmin() || $state->isOwnedBy($user);
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
     * @param State $state
     * @return bool
     */
    public function update(User $user, State $state): bool
    {
        return $user->isAdmin() || $state->isOwnedBy($user);
    }

    /**
     * @param User $user
     * @param State $state
     * @return bool
     */
    public function delete(User $user, State $state): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param State $state
     * @return bool
     */
    public function restore(User $user, State $state): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param State $state
     * @return bool
     */
    public function forceDelete(User $user, State $state): bool
    {
        return false;
    }
}
