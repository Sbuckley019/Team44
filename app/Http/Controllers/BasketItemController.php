<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasketItem;

// fetch the basket item details based on $basket_id
class BasketItemController extends Controller
{
    public function show($basket_id)
    {
        $basketItem = BasketItem::findOrFail($basket_id);
        return view('basketitem.show', compact('basketItem'));
    }

    // editing the quantity of a basket item
    public function editQuantity($basket_id, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $basketItem = BasketItem::findOrFail($basket_id);
        $basketItem->update(['quantity' => $request->input('quantity')]);

        return redirect()->route('basket.index');
    }

    // remove the item from the basket
    public function removeFromBasket($basket_id)
    {
        $basketItem = BasketItem::findOrFail($basket_id);
        $basketItem->delete();

        return redirect()->route('basket.index');
    }
}
