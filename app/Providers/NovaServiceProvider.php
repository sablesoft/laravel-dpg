<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Giuga\LaravelNovaSidebar\NovaSidebar;
use Eolica\NovaLocaleSwitcher\LocaleSwitcher;
use BinaryBuilds\NovaAdvancedCommandRunner\CommandRunner;
use App\Models\User;
use App\Models\Language;

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
    protected function cards(): array
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
    protected function dashboards(): array
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [
            LocaleSwitcher::make()
                ->setLocales(Language::getList())
                ->onSwitchLocale(function ($request) {
                    $locale = $request->post('locale');
                    /** @var User $user */
                    $user = $request->user();
                    $user->updateLanguage($locale);
                }),
            (new NovaSidebar())->hydrate([
                __('Club') => [
                    [__('Dashboard'), '/dashboard', '_self'],
                ],
            ]),
            CommandRunner::make()->canSee(function ($request) {
                return $request->user()->isAdmin();
            }),
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
