<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use App\Models\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share([
            // ...
            'locale' => function () {
                /** @var User $user */
                $user = auth()->user();
                if ($user && $user->language) {
                    return $user->language->code;
                }

                return app()->getLocale();
            },
            'language' => function () {
                return translations(
                    app_path('../lang/'. app()->getLocale() .'.json')
                );
            },
            'locales' => Language::getList()
        ]);
    }
}
