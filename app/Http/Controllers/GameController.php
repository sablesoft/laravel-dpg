<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Game;
use App\Service\BoardService;

class GameController extends Controller
{
    /**
     * @param Game $game
     * @return Response
     */
    public function init(Game $game): Response
    {
        return Inertia::render('Game', [
            'game' => BoardService::gameToArray($game)
        ]);
    }

    /**
     * @param Game $game
     * @return array
     */
    public function json(Game $game): array
    {
        return BoardService::gameToArray($game);
    }
}
