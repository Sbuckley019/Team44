<?php

namespace App\Listeners;

use App\Events\BasketChanged;
use App\Http\Controllers\BasketController;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshBasketListener implements ShouldQueue
{
    public function handle(BasketChanged $event)
    {
        $basketController = new BasketController();
        $basketController->sessionBasket();
    }
}
