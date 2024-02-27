<?php

namespace App\Providers;

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Favourites;
use App\Observers\FavouriteObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Favourites::observe(FavouriteObserver::class);
    }
}
