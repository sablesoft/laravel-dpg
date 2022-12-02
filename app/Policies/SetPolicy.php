<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Set;
use App\Models\User;
use App\Models\Card;

class SetPolicy
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
     * @param Set $set
     * @return mixed
     */
    public function view(User $user, Set $set): bool
    {
        return $user->isAdmin() || $set->isOwnedBy($user);
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
     * @param Set $set
     * @return bool
     */
    public function update(User $user, Set $set): bool
    {
        return $user->isAdmin() || $set->isOwnedBy($user);
    }

    /**
     * @param User $user
     * @param Set $set
     * @return bool
     */
    public function delete(User $user, Set $set): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param Set $set
     * @return bool
     */
    public function restore(User $user, Set $set): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param Set $set
     * @return bool
     */
    public function forceDelete(User $user, Set $set): bool
    {
        return false;
    }

    /**
     * Determine whether the user can attach any card to the set.
     *
     * @param User $user
     * @param Set $set
     * @return bool
     */
    public function attachAnyCard(User $user, Set $set): bool
    {
        return $user->isAdmin() || $set->isOwnedBy($user);
    }

    /**
     * Determine whether the user can attach card to the set.
     *
     * @param User $user
     * @param Set $set
     * @param Card $card
     * @return bool
     */
    public function attachCard(User $user, Set $set, Card $card): bool
    {
        return $user->isAdmin() || $set->isOwnedBy($user);
    }

    /**
     * Determine whether the user can detach card from the set.
     *
     * @param User $user
     * @param Set $set
     * @param Card $card
     * @return bool
     */
    public function detachCard(User $user, Set $set, Card $card): bool
    {
        return $user->isAdmin() || $set->isOwnedBy($user);
    }

    /**
     * Determine whether the user can add card to the set.
     *
     * @param User $user
     * @param Set $set
     * @return bool
     */
    public function addCard(User $user, Set $set): bool
    {
        return $user->isAdmin() || $set->isOwnedBy($user);
    }
}
