<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Game;
use App\Service\BoardService;

class GameController extends Controller
{
    /**
     * @param int $id
     * @return Response
     */
    public function init(int $id): Response
    {
        /** @var Game|null $game */
        if (!$game = Game::find($id)->first()) {
            redirect('/');
        }

        return Inertia::render('Game', [
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
