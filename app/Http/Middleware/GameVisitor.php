<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\Game;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class GameVisitor
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        /** @var Game $game */
        $game = $request->route('game');
        /** @var User $user */
        $user = Auth::user();
        if (!$game->canBeVisitedBy($user)) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
