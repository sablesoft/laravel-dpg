<?php

namespace App\Policies;

use App\Models\Card;
use App\Models\Game;
use App\Models\Deck;
use App\Models\User;

class GamePolicy
{

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
     * // todo - check status and players
     *
     * @param User $user
     * @param Game $game
     * @return mixed
     */
    public function view(User $user, Game $game): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
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
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function delete(User $user, Game $game): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function restore(User $user, Game $game): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function forceDelete(User $user, Game $game): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * Determine whether the user can attach any card to the content.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function attachAnyCard(User $user, Game $game): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * Determine whether the user can attach card to the content.
     *
     * @param User $user
     * @param Game $game
     * @param Card $card
     * @return bool
     */
    public function attachCard(User $user, Game $game, Card $card): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * Determine whether the user can add card to the content.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function addCard(User $user, Game $game): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * Determine whether the user can detach card from the content.
     *
     * @param User $user
     * @param Game $game
     * @param Card $card
     * @return bool
     */
    public function detachCard(User $user, Game $game, Card $card): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * Determine whether the user can attach any deck to the content.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function attachAnyDeck(User $user, Game $game): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * Determine whether the user can attach deck to the content.
     *
     * @param User $user
     * @param Game $game
     * @param Deck $deck
     * @return bool
     */
    public function attachDeck(User $user, Game $game, Deck $deck): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * Determine whether the user can add deck to the content.
     *
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function addDeck(User $user, Game $game): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }

    /**
     * Determine whether the user can detach deck from the content.
     *
     * @param User $user
     * @param Game $game
     * @param Deck $deck
     * @return bool
     */
    public function detachDeck(User $user, Game $game, Deck $deck): bool
    {
        return $user->isAdmin() ||
            $user->getKey() == $game->master_id;
    }
}
