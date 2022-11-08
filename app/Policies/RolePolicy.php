<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePolicy
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
        return $user->hasRole(User::ROLE_ADMIN);
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Role $role
     * @return mixed
     */
    public function view(User $user, Role $role): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
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
     * @param Role $role
     * @return bool
     */
    public function update(User $user, Role $role): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }

    /**
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }

    /**
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function restore(User $user, Role $role): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }

    /**
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }
}
