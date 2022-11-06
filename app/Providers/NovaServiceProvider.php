<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Eolica\NovaLocaleSwitcher\LocaleSwitcher;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::serving(function (ServingNova $event) {
            /** @var User $user */
            $user = $event->request->user();

            if ($locale = optional($user->language)->code) {
                app()->setLocale($locale);
            }
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            LocaleSwitcher::make()
                ->setLocales(config('nova.locales'))
                ->onSwitchLocale(function ($request) {
                    $locale = $request->post('locale');

                    if (array_key_exists($locale, config('nova.locales'))) {
                        $request->user()->update(['locale' => $locale]);
                    }
                })
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
