<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // retrieves authenticated user instance
            $user = auth()->user();
            // retrieves basket for the current user
            $basket = Basket::where('user_id', $user->id)->with('items.product')->first();
        } else {
            $guestBasket = $this->getGuestBasket();
            $basket = (object)[
                'user_id' => null,
                'items' => collect($guestBasket->items)->map(function ($item) {
                    // Assuming you have a Product model
                    $product = Product::find($item->product_id);
                    return (object)[
                        'product' => $product,
                        'quantity' => $item->quantity,
                    ];
                })->toArray(),
            ];
        }

        return view('Basket', compact('basket'));
    }

    public function addProduct($productId)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $basket = Basket::firstOrCreate(['user_id' => $user->id], ['user_id' => $user->id]);
        } else {
            $basket = $this->getOrCreateGuestBasket();
        }

        // Check if the product is already in the basket
        $existingItem = collect($basket->items)->first(function ($item) use ($productId) {
            return $item->product_id === $productId;
        });

        // If the item exists in the basket already, increment the quantity
        // Otherwise, add the product with quantity 1
        if ($existingItem) {
            $existingItem->quantity++;
        } else {
            $basket->items[] = (object)['product_id' => $productId, 'quantity' => 1];
        }

        // Update the guest basket if applicable
        if (!Auth::check()) {
            $this->updateGuestBasket($basket);
        }

        return redirect()->route('basket.index');
    }

    public function removeProduct($productId)
    {
        $user = auth()->user();
        $basket = Basket::where('user_id', $user->id)->first();

        // remove a product from the basket
        if ($basket) {
            $basket->items()->where('product_id', $productId)->delete();
        }
        return redirect()->route('basket.index');
    }

    public function editQuantity($productId, Request $request)
    {
        $user = auth()->user();
        $basket = Basket::where('user_id', $user->id)->first();

        // update the quantity of a product in the basket
        if ($basket) {
            $quantity = $request->input('quantity');
            $basket->items()->where('product_id', $productId)->update(['quantity' => $quantity]);
        }
    }

    public function getGuestBasket()
    {
        return session('basket', (object)['user_id' => null, 'items' => []]);
    }

    public function getOrCreateGuestBasket()
    {
        $guestBasket = $this->getGuestBasket();

        // If guest basket does not exist, create it
        if (empty($guestBasket->user_id)) {
            $guestBasket = (object)[
                'user_id' => null,
                'items' => [],
            ];

            $this->updateGuestBasket($guestBasket);
        }

        return $guestBasket;
    }

    public function updateGuestBasket($basket)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $existingBasket = Basket::firstOrCreate(['user_id' => $user->id], ['user_id' => $user->id]);
        } else {
            $existingBasket = $this->getGuestBasket();
        }

        if (!isset($existingBasket->items)) {
            $existingBasket->items = [];
        }

        foreach ($basket->items as $item) {
            $existingItemIndex = collect($existingBasket->items)->search(function ($existingItem) use ($item) {
                return $existingItem->product_id === $item->product_id;
            });

            if ($existingItemIndex !== false) {
                $existingBasket->items[$existingItemIndex]->quantity += $item->quantity;
            } else {
                $existingBasket->items[] = $item;
            }
        }

        if (Auth::check()) {
            // If the user is authenticated, clear the guest basket
            $this->updateGuestBasket((object)['user_id' => null, 'items' => []]);
        } else {
            // If the user is not authenticated, update the guest basket
            session(['basket' => $existingBasket]);
        }
    }
}
