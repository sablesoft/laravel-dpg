<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Models\Game;
use App\Enums\GameSubscribe;
use App\Service\GameService;
use App\Models\Process\Process;
use App\Models\Process\DomeProcess;
use App\Models\Process\GameProcess;
use App\Models\Process\AreaProcess;
use App\Models\Process\BookProcess;
use App\Models\Process\CardProcess;
use App\Models\Process\DeckProcess;
use App\Models\Process\LandProcess;
use App\Models\Process\SceneProcess;

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
            $role = GameSubscribe::Master->code();
        } else {
            $role = GameSubscribe::from($subscriber->pivot->type)->code();
        }

        return Inertia::render('Game', [
            'data' => $process,
            'role' => $role
        ]);
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function update(Request $request): array
    {
        /** @var GameProcess $gameProcess */
        $gameProcess = GameProcess::where('id', $request->json('gameId'))->first();
        if (!$gameProcess) {
            throw new Exception('Process not found!');
        }
        /** @var Process|GameProcess $process */
        $process = $this->_process(
            $gameProcess,
            $request->json('process'),
            $request->json('processId')
        );
        $fields = $request->json('fields');
        if (!$fields || !is_array($fields)) {
            throw new Exception('Fields list must be array!');
        }
        foreach ($fields as $field) {
            $process->$field = $request->json($field);
        }

        return ['success' => $process->save()];
    }

    /**
     * @param GameProcess $gameProcess
     * @param string $type
     * @param int|null $processId
     * @return GameProcess|Process
     * @throws Exception
     */
    protected function _process(GameProcess $gameProcess, string $type, ?int $processId = null): GameProcess|Process
    {
        /** @var Process|GameProcess $process */
        $process = match ($type) {
            'game' => $gameProcess,
            'book' => BookProcess::where(Process::GAME_FOREIGN_KEY, $gameProcess->getKey())
                ->where('id', $processId)->first(),
            'card' => CardProcess::where(Process::GAME_FOREIGN_KEY, $gameProcess->getKey())
                ->where('id', $processId)->first(),
            'deck' => DeckProcess::where(Process::GAME_FOREIGN_KEY, $gameProcess->getKey())
                ->where('id', $processId)->first(),
            'dome' => DomeProcess::where(Process::GAME_FOREIGN_KEY, $gameProcess->getKey())
                ->where('id', $processId)->first(),
            'land' => LandProcess::where(Process::GAME_FOREIGN_KEY, $gameProcess->getKey())
                ->where('id', $processId)->first(),
            'area' => AreaProcess::where(Process::GAME_FOREIGN_KEY, $gameProcess->getKey())
                ->where('id', $processId)->first(),
            'scene' => SceneProcess::where(Process::GAME_FOREIGN_KEY, $gameProcess->getKey())
                ->where('id', $processId)->first(),
            default => throw new Exception(__('Invalid process type')),
        };
        if (!$process) {
            throw new Exception(__('Process not found!'));
        }

        return $process;
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
