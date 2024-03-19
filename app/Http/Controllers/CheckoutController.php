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
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'card_number' => 'required|int|max:16',
            'expiry_date' => 'required|int|max:5',
            'cvv' => 'required|int|max:3',

        ]);

        $user = auth()->user();

        // Process the order for both authenticated and guest users
        $order = $this->createOrder($request);

        if ($request->has('save_info')) {
            // Save user information to the database
            $user = auth()->user(); // Assuming the user is authenticated
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->phone_number = $request->input('phone_number');
            $user->email = $request->input('email');
            $user->address = $request->input('address');

            /** @var \App\Models\User $user */
            $user->save();
        }

        // Redirect with success message
        return redirect()->route('order.show', ['order' => $order->id]);
    }

    private function clearBasket()
    {
        $user = auth()->user();

        // Delete all basket items for the user
        BasketItem::where('user_id', $user->id)->delete();
    }

    private function createOrder(Request $request)
    {
        // Assuming you have an authenticated user
        $user = auth()->user();

        // Create a new order
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $this->calculateTotalPrice(); // Implement your own logic
        // Add other fields as needed
        $order->save();

        // Retrieve basket items for the user
        $basketItems = BasketItem::where('user_id', $user->id)->get();

        // Save order items
        foreach ($basketItems as $basketItem) {
            $order->items()->create([
                'product_id' => $basketItem->product_id,
                'quantity' => $basketItem->quantity,
                'price' => $basketItem->product->price,
                // Add other fields as needed
            ]);
        }

        // Clear the user's basket (assuming you have a method for this)
        $this->clearBasket();

        return $order;
    }

    private function calculateTotalPrice()
    {
        $user = auth()->user();

        // Retrieve basket items for the user
        $basketItems = BasketItem::where('user_id', $user->id)->get();

        // Calculate the total price
        $totalPrice = 0;

        foreach ($basketItems as $basketItem) {
            $totalPrice += $basketItem->quantity * $basketItem->product->price;
        }

        return $totalPrice;
    }

    public function showOrder($orderId)
    {
        // Retrieve the order details from the database
        $order = Order::find($orderId);

        // Pass order details to the view
        return view('orders.show', ['order' => $order]);
    }
}
