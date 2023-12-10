<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Product;

class BasketController extends Controller
{
    public function index()
    {
        // retrieves authenticated user instance
        $user = auth()->user();
        // retrieves basket for current user
        $basket = Basket::where('customer_id', $user->id)->with('items.product')->first();
        // load view with basket data
        return view('basket.index', compact('basket'));
    }

    public function addProduct($productId)
    {
        $user = auth()->user();
        $basket = Basket::firstOrCreate(['customer_id' => $user->id]);

        // check if the product is already in the basket
        $existingItem = $basket->items()->where('product_id', $productId)->first();

        // if the item exists in the basket already, the quantity will be incremented
        // otherwise the product will be added with quantity 1
        if ($existingItem) {
            $existingItem->increment('quantity');
        } else {
            $basketItem = new BasketItem(['product_id' => $productId, 'quantity' => 1]);
            $basket->items()->save($basketItem);
        }
        return redirect()->route('basket.index');
    }

    public function removeProduct($productId)
    {
        $user = auth()->user();
        $basket = Basket::where('customer_id', $user->id)->first();

        // remove a product from the basket
        if ($basket) {
            $basket->items()->where('product_id', $productId)->delete();
        }
        return redirect()->route('basket.index');
    }

    public function editQuantity($productId, Request $request)
    {
        $user = auth()->user();
        $basket = Basket::where('customer_id', $user->id)->first();

        // update the quantity of a product in the basket
        if ($basket) {
            $quantity = $request->input('quantity');
            $basket->items()->where('product_id', $productId)->update(['quantity' => $quantity]);
        }
    }
}
