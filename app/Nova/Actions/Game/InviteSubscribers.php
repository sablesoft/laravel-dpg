<?php

namespace App\Nova\Actions\Game;

use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Models\Game;
use App\Enums\GameStatus;

class InviteSubscribers extends Action
{
    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name(): string
    {
        return '1 - ' . __('Invite Subscribers');
    }

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return array
     */
    public function handle(ActionFields $fields, Collection $models): array
    {
        /** @var Game $game */
        $game = $models->first();
        if ($game->status !== GameStatus::Preview) {
            return Action::danger(__('Cannot invite game subscribers. Invalid game status!'));
        }

        // todo - invite flow

        $game->status = GameStatus::Invite;
        $game->save();

        return Action::message(__('Subscribers Invited!'));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(): array
    {
        return [];
    }
}
