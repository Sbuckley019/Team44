<?php

namespace App\Observers;

use App\Http\Controllers\FavouritesController;
use App\Models\Favourites;

class FavouriteObserver
{
    /**
     * Handle the Favourites "created" event.
     */
    public function created(Favourites $favourites): void
    {
        $favouriteController = new FavouritesController();
        $favouriteController->sessionFavourites();
    }

    /**
     * Handle the Favourites "deleted" event.
     */
    public function deleted(Favourites $favourites): void
    {
        $favouriteController = new FavouritesController();
        $favouriteController->sessionFavourites();
    }
}
