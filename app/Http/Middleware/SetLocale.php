<?php

namespace App\Http\Middleware;

use Closure;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Language;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = auth()->user();

        if($user && $user->language) {
            app()->setLocale($user->language->code);
        } else {
            app()->setLocale(config('app.locale'));
        }

        Inertia::share([
            'locale' => app()->getLocale(),
            'language' => function () {
                return translations(
                    app_path('../lang/'. app()->getLocale() .'.json')
                );
            },
            'locales' => Language::getList()
        ]);

        return $next($request);
    }
}
