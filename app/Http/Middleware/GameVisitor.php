<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Process\GameProcess;
use App\Providers\RouteServiceProvider;

class GameVisitor
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        /** @var GameProcess $process */
        $process = $request->route('process');
        /** @var User $user */
        $user = Auth::user();
        $game = $process->getGame();
        if (!$game->canBeVisitedBy($user)) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
