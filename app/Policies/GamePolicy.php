<?php

namespace App\Policies;

use App\Models\Set;
use App\Models\User;
use App\Models\Game;
use App\Models\Stack;
use App\Models\State;

class GamePolicy
{

    /**
     * Determine whether the user can view the model.
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
     * @param Game $game
     * @return mixed
     */
    public function view(User $user, Game $game): bool
    {
        return $game->canBeVisitedBy($user);
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
     * @param Game $game
     * @return bool
     */
    public function update(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function delete(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function restore(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function forceDelete(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can attach any subscriber to the game.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function attachAnyUser(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can attach subscriber to the game.
     *
     * @param User $user
     * @param Game $game
     * @param User $subscriber
     * @return bool
     */
    public function attachUser(User $user, Game $game, User $subscriber): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can detach subscriber from the game.
     *
     * @param User $user
     * @param Game $game
     * @param User $subscriber
     * @return bool
     */
    public function detachUser(User $user, Game $game, User $subscriber): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user) ||
            $user->getKey() === $subscriber->getKey();
    }

    /**
     * Determine whether the user can attach any state to the game.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function attachAnyState(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can attach state to the game.
     *
     * @param User $user
     * @param Game $game
     * @param State $state
     * @return bool
     */
    public function attachState(User $user, Game $game, State $state): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can add state to the game.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function addState(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can detach state from the game.
     *
     * @param User $user
     * @param Game $game
     * @param State $state
     * @return bool
     */
    public function detachState(User $user, Game $game, State $state): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can attach any set to the game.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function attachAnySet(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can attach set to the game.
     *
     * @param User $user
     * @param Game $game
     * @param Set $set
     * @return bool
     */
    public function attachSet(User $user, Game $game, Set $set): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can add set to the game.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function addSet(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can detach set from the game.
     *
     * @param User $user
     * @param Game $game
     * @param Set $set
     * @return bool
     */
    public function detachSet(User $user, Game $game, Set $set): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can attach any set to the game.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function attachAnyStack(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can attach stack to the game.
     *
     * @param User $user
     * @param Game $game
     * @param Stack $stack
     * @return bool
     */
    public function attachStack(User $user, Game $game, Stack $stack): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can add stack to the game.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function addStack(User $user, Game $game): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }

    /**
     * Determine whether the user can detach stack from the game.
     *
     * @param User $user
     * @param Game $game
     * @param Stack $stack
     * @return bool
     */
    public function detachStack(User $user, Game $game, Stack $stack): bool
    {
        return $user->isAdmin() || $game->isOwnedBy($user);
    }
}
