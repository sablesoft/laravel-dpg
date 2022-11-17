<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Stack;

class StackPolicy
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
        // todo
        return true;
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Stack $stack
     * @return mixed
     */
    public function view(User $user, Stack $stack): bool
    {
        // todo
        return true;
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
     * @param Stack $stack
     * @return bool
     */
    public function update(User $user, Stack $stack): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Stack $stack
     * @return bool
     */
    public function delete(User $user, Stack $stack): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param Stack $stack
     * @return bool
     */
    public function restore(User $user, Stack $stack): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param Stack $stack
     * @return bool
     */
    public function forceDelete(User $user, Stack $stack): bool
    {
        return false;
    }
}
