<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Models\Game;
use App\Enums\GameSubscribe;
use App\Service\GameService;
use App\Models\Process\GameProcess;

class GameController extends Controller
{
    /**
     * @param GameProcess $process
     * @return Response
     * @throws Exception
     */
    public function process(GameProcess $process): Response
    {
        $game = $process->getGame();
        /** @var User|null $subscriber */
        if (!$subscriber = $game->subscribers()->where('subscriber_id', Auth::id())->first()) {
            if ($game->owner_id !== Auth::id()) {
                throw new Exception(__('Unknown game user!'));
            }
            $role = GameSubscribe::Master->value;
        } else {
            $role = $subscriber->pivot->type;
        }

        return Inertia::render('Game', [
            'data' => $process,
            'user_role' => $role
        ]);
    }

    /**
     * @param Game $game
     * @return array
     * @throws Exception
     */
    public function json(Game $game): array
    {
        return GameService::initProcess($game, App::currentLocale())->toArray();
    }
}
