<?php

namespace App\Http\Controllers;

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
     */
    public function init(Game $game): Response
    {
        return Inertia::render('Game', [
            'data' => GameService::gameToArray($game, App::currentLocale())
        ]);
    }

    /**
     * @param Game $game
     * @return array
     */
    public function json(Game $game): array
    {
        return GameService::gameToArray($game, App::currentLocale());
    }
}
