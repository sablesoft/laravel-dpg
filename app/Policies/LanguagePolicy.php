<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Language;

class LanguagePolicy
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
     * @param Language $language
     * @return mixed
     */
    public function view(User $user, Language $language): bool
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
     * @param Language $language
     * @return bool
     */
    public function update(User $user, Language $language): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }

    /**
     * @param User $user
     * @param Language $language
     * @return bool
     */
    public function delete(User $user, Language $language): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }

    /**
     * @param User $user
     * @param Language $language
     * @return bool
     */
    public function restore(User $user, Language $language): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }

    /**
     * @param User $user
     * @param Language $language
     * @return bool
     */
    public function forceDelete(User $user, Language $language): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }
}
