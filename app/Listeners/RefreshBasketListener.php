<?php

namespace App\Listeners;

use App\Events\BasketItemChanged;
use App\Http\Controllers\BasketController;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshBasketListener implements ShouldQueue
{
    public function handle(BasketItemChanged $event)
    {
        $basketController = new BasketController();
        $basketController->sessionBasket();
    }
}
