<?php

namespace App\Http\Controllers;

use App\Service\BoardService;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Game;

class BoardController extends Controller
{
    /**
     * @return Response
     */
    public function dashboard(): Response
    {
        /** @var Game $game */
        $game = Game::select()->first();

        return Inertia::render('Dashboard', [
            'game' => BoardService::gameToArray($game)
        ]);
    }

    public function test()
    {
        /** @var Game $game */
        $game = Game::select()->first();
        return BoardService::gameToArray($game);
    }
}
