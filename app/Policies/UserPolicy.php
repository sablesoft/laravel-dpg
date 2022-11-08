<?php

namespace App\Policies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class UserPolicy
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
     * @param Model $model
     * @return mixed
     */
    public function view(User $user, Model $model): bool
    {
        return $user->hasRole(User::ROLE_ADMIN) ||
            ($user->getKey() === $model->getKey());
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }

    /**
     * @param User $user
     * @param Model $model
     * @return bool
     */
    public function update(User $user, Model $model): bool
    {
        return $user->hasRole(User::ROLE_ADMIN) ||
            ($user->getKey() === $model->getKey());
    }

    /**
     * @param User $user
     * @param Model $model
     * @return bool
     */
    public function delete(User $user, Model $model): bool
    {
        return $user->hasRole(User::ROLE_ADMIN) ||
            ($user->getKey() === $model->getKey());
    }

    /**
     * @param User $user
     * @param Model $model
     * @return bool
     */
    public function restore(User $user, Model $model): bool
    {
        return $user->hasRole(User::ROLE_ADMIN) ||
            ($user->getKey() === $model->getKey());
    }

    /**
     * @param User $user
     * @param Model $model
     * @return bool
     */
    public function forceDelete(User $user, Model $model): bool
    {
        return $user->hasRole(User::ROLE_ADMIN) ||
            ($user->getKey() === $model->getKey());
    }
}
