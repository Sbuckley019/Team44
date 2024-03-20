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
    }
}
