<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Game;
use App\Service\GameService;

class GameController extends Controller
{
    /**
     * @param Game $game
     * @return Response
     * @throws Exception
     */
    public function init(Game $game): Response
    {
        return Inertia::render('Game', [
            'data' => GameService::initProcess($game, App::currentLocale())
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
