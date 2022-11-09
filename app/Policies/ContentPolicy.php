<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Content;

abstract class ContentPolicy
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
     * @param Content $content
     * @return mixed
     */
    public function view(User $user, Content $content): bool
    {
        return $user->isAdmin() ||
            $user->isOwner($content) ||
            $content->is_public;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Content $content
     * @return bool
     */
    public function update(User $user, Content $content): bool
    {
        return $user->isAdmin() || $user->isOwner($content);
    }

    /**
     * @param User $user
     * @param Content $content
     * @return bool
     */
    public function delete(User $user, Content $content): bool
    {
        return $user->isAdmin() || $user->isOwner($content);
    }

    /**
     * @param User $user
     * @param Content $content
     * @return bool
     */
    public function restore(User $user, Content $content): bool
    {
        return $user->isAdmin() || $user->isOwner($content);
    }

    /**
     * @param User $user
     * @param Content $content
     * @return bool
     */
    public function forceDelete(User $user, Content $content): bool
    {
        return $user->isAdmin() || $user->isOwner($content);
    }
}
