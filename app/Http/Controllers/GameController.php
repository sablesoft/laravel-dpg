<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
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
use App\Models\Process\JournalProcess;

class GameController extends Controller
{
    /**
     * @param Request $request
     * @param GameProcess $process
     * @return Response
     * @throws Exception
     */
    public function process(Request $request, GameProcess $process): Response
    {
        /** @var User $user */
        $user = Auth::user();
        return Inertia::render('Game', [
            'data' => $process,
            'customerId' => $user->getKey(),
            'customerName' => $user->name,
            'role' => $this->_role($process, $user)
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return array
     * @throws Exception
     */
    public function turn(Request $request, User $user): array
    {
        $processes = $request->json()->all();
        $gameData = reset($processes['game']);
        /** @var GameProcess $gameProcess */
        $gameProcess = GameProcess::where('id', $gameData['id'])->first();
        if (!$gameProcess) {
            throw new Exception('Process not found!');
        }

        $role = $this->checkTurnRole($gameProcess, $user);

        foreach ($processes as $processName => $processRequest) {
            foreach ($processRequest as $id => $data) {
                /** @var Process|GameProcess $process */
                $process = $this->_process($gameProcess, $processName, $id);
                foreach ($data as $field => $value) {
                    $process->$field = $value;
                }
                if (!$process->save()) {
                    throw new Exception('Process saving error - ' . $processName);
                }
            }
        }

        return [
            'success' => true,
            'turn' => $this->takeTurn($gameProcess, $user, $role),
            'journal' => $gameProcess->journal->toArray()
        ];
    }

    /**
     * @param GameProcess $process
     * @param User $user
     * @return string
     * @throws Exception
     */
    protected function checkTurnRole(GameProcess $process, User $user): string
    {
        $role = $this->_role($process, $user, false);
        if ($role !== $process->turn || in_array($user->getKey(), (array) $process->played_ids)) {
            throw new Exception('This customer doesnt have turn now!');
        }

        return $role;
    }

    /**
     * @param GameProcess $process
     * @param User $user
     * @param string $role
     * @return string
     */
    protected function takeTurn(GameProcess $process, User $user, string $role): string
    {
        if ($role === GameSubscribe::Master->code()) {
            $process->turn = GameSubscribe::Player->code();
        } else {
            $playedIds = (array) $process->played_ids;
            $playedIds[] = $user->getKey();
            $totalCount = $process->getGame()->subscribers()
                ->where('type', GameSubscribe::Player->value)->count();
            if (count($playedIds) === $totalCount) {
                $process->turn = GameSubscribe::Master->code();
                $playedIds = [];
            }
            $process->played_ids = $playedIds;
        }
        $process->save();

        return $process->turn;
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
            'journal' => JournalProcess::create([Process::GAME_FOREIGN_KEY => $gameProcess->getKey()]),
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
     * @param GameProcess $process
     * @param User $user
     * @param bool $checkTurn
     * @return string
     * @throws Exception
     */
    protected function _role(GameProcess $process, User $user, bool $checkTurn = true): string
    {
        $game = $process->getGame();
        /** @var User|null $subscriber */
        if (!$subscriber = $game->subscribers()->where('subscriber_id', $user->getKey())->first()) {
            if ($game->owner_id !== $user->getKey()) {
                throw new Exception(__('Unknown game user!'));
            }
            $role = GameSubscribe::Master;
        } else {
            $role = GameSubscribe::from($subscriber->pivot->type);
        }

        if ($checkTurn) {
            switch ($role->value) {
                case GameSubscribe::Player->value:
                    if ($process->turn !== GameSubscribe::Player->code()) {
                        $role = GameSubscribe::Spectator;
                    }
                    break;
                case GameSubscribe::Master->value:
                    if ($process->turn !== GameSubscribe::Master->code()) {
                        $role = GameSubscribe::Expert;
                    }
                    break;
                default:
                    break;
            }
        }

        return $role->code();
    }

    /**
     * @param Game $game
     * @return array
     * @throws Exception
     */
    public function json(Game $game): array
    {
        return GameService::initProcess($game)->toArray();
    }
}
