<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        app()->setLocale(config('app.locale'));
        /** @var User $user */
        $user = auth()->user();

        if($user && $user->language) {
            app()->setLocale($user->language->code);
        }

        return $next($request);
    }
}
