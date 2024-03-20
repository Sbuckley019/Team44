<?php

namespace App\Http\Controllers;

use App\Events\BasketItemChanged;
use Illuminate\Http\Request;
use App\Models\Basket;
use App\Services\BasketService;
use App\Models\BasketItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BasketController extends Controller
{
    public function index()
    {
        $basket = session()->get('basket');

        return view('Basket', compact('basket'));
    }


    public function addOrUpdateProduct(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        $basketService = new BasketService();

        if (Auth::check()) {
            $user = Auth::user();
            $basket = Basket::firstOrCreate(['user_id' => $user->id], ['user_id' => $user->id]);
        } else {
            $guest_id = Cookie::get('guest_id');
            $basket = Basket::firstOrCreate(['guest_id' => $guest_id], ['guest_id' => $guest_id]);
        }
        // Check if the product is already in the basket
        $existingItem = $basket->items()->where('product_id', $productId)->first();

        // If the item exists in the basket already, increment the quantity
        // Otherwise, add the product with quantity 1
        if ($existingItem) {
            $existingItem->increment('quantity');
        } else {
            $basketItem = new BasketItem(['product_id' => $productId, 'quantity' => 1]);
            $basket->items()->save($basketItem);
        }

        $product = Product::findOrFail($productId);

        session()->flash('basketItem', [
            'name' => $product->product_name
        ]);

        event(new BasketItemChanged());

        return redirect()->back()->with('info', ' added to basket');
    }


    public function removeProduct($productId)
    {
        if (Auth::check()) {
            $user = auth()->user()->id;
            $basket = Basket::where('user_id', $user)->first();
        } else {
            $guest = Cookie::get('guest_id');
            $basket = Basket::where('guest_id', $guest)->first();
        }
        // remove a product from the basket
        if ($basket) {
            $basket->items()->where('product_id', $productId)->delete();
        }

        event(new BasketItemChanged());

        return redirect()->route('basket.index')->with('info', 'removed from basket');
    }

    public function editQuantity($productId, Request $request)
    {
        if (Auth::check()) {
            $user = auth()->user()->id;
            $basket = Basket::where('user_id', $user)->first();
        } else {
            $guest = Cookie::get('guest_id');
            $basket = Basket::where('guest_id', $guest)->first();
        }

        $plusOrMinus = $request->input('action');

        // update the quantity of a product in the basket
        if ($basket) {
            $quantity = $basket->items()->where('product_id', $productId)->value('quantity');
            if ($plusOrMinus) {
                $basket->items()->where('product_id', $productId)->increment('quantity', 1);
            } else if ($quantity > 1) {
                $basket->items()->where('product_id', $productId)->decrement('quantity', 1);
            } else {
                $this->removeProduct($productId);
            }
        }

        event(new BasketItemChanged());

        return redirect()->route('basket.index');
    }

    public function emptyBasket($basket_id)
    {
        $basketService = new BasketService();
        $basketService->emptyBasket($basket_id);
    }

    public function guestToUser()
    {
        $user = Auth::user();

        // checks if there is an authenticated user
        if ($user) {
            if (!Basket::where('user_id', $user->id)) {
                $guest_id = Cookie::get('guest_id');

                $basket = Basket::where(['guest_id' => $guest_id])->first();

                if ($basket) {
                    $basket->update(['user_id' => $user->id, 'guest_id' => null]);
                }
            }
        }
    }

    public function sessionBasket()
    {
        if (Auth::check()) {
            // retrieves authenticated user instance
            $user = auth()->user();
            // retrieves basket for the current user
            $basket = Basket::where('user_id', $user->id)->with('items.product')->first();
        } else {
            $basket = Basket::where('guest_id', Cookie::get('guest_id'))->with('items.product')->first();
        }

        session()->put('basket', $basket);
    }
}
