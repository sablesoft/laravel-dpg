<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Tag;
use App\Models\Card;
use App\Models\Deck;
use App\Models\Scope;
use App\Models\Adventure;
use App\Observers\OwnerObserver;

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
        Adventure::observe(OwnerObserver::class);
        Card::observe(OwnerObserver::class);
        Deck::observe(OwnerObserver::class);
        Scope::observe(OwnerObserver::class);
        Tag::observe(OwnerObserver::class);
    }
}
