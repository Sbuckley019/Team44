<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Basket;
use App\Models\BasketItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $basket = null;

        if ($user) {
            // User is authenticated
            $basket = Basket::where('user_id', $user->id)->with('items.product')->first();
        } else {
            // User is a guest
            $guestId = Cookie::get('guest_id');
            if ($guestId) {
                $basket = Basket::where('guest_id', $guestId)->with('items.product')->first();
            }
        }

        return view('checkout', compact('basket'));
    }


    public function processCheckout(Request $request)
    {


        // Assuming you have an authenticated user
        $user = auth()->user();


        // Retrieve basket items for the user
        $basket = Basket::where('user_id', $user->id)->select('basket_id');
        $basketItems = BasketItem::where('basket_id', $basket);

        // Create a new order
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $this->calculateTotalPrice($basketItems);
        $order->save();
        // Save order items
        foreach ($basket as $basketItems) {
            $order->items()->create([
                'product_id' => $basketItems->product_id,
                'quantity' => $basketItems->quantity,
                'price' => $basketItems->product->price
            ]);
        }

        // Clear the user's basket using $this->clearBasket()
        $this->clearBasket();

        if ($request->has('save_info')) {
            // Save user information to the database
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->phone_number = $request->input('phone_number');
            $user->email = $request->input('email');
            $user->address = $request->input('address');

            /** @var \App\Models\User $user */
            $user->save();
        }

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }


    private function clearBasket()
    {
        $user = auth()->user();

        // Delete all basket items for the user
        $basket = Basket::where('user_id', $user->id)->select('basket_id');
        $basketItems = BasketItem::where('basket_id', $basket)->delete();
    }

    private function calculateTotalPrice($basketItems = null)
    {
        $user = auth()->user();
        $basket = Basket::where('user_id', $user->id)->select('basket_id');
        // Calculate the total price
        $totalPrice = 100;

        foreach ($basket as $basketItems) {
            $totalPrice += $basketItems->quantity * $basketItems->product->price;
        }

        return $totalPrice;
    }
}
