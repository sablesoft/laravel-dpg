<?php

namespace App\Nova\Actions\Game;


use Exception;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Models\Game;
use App\Enums\GameStatus;
use App\Service\GameService;

class InitProcess extends Action
{
    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name(): string
    {
        return '2 - '. __('Init Process');
    }

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return array
     * @throws Exception
     */
    public function handle(ActionFields $fields, Collection $models): array
    {
        /** @var Game $game */
        $game = $models->first();
        if ($game->status !== GameStatus::Invite) {
            return Action::danger(__('Cannot init game process. Invalid game status!'));
        }
        GameService::initProcess($game);
        $game->status = GameStatus::Process;
        $game->save();

        return Action::message(__('Game process created!'));
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
