<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Inertia\Inertia;

class OrderController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::id();

            $orders = Order::with(['orderItems.product'])
                ->where('user_id', $user)
                ->get();
        }


        return Inertia::render('Orders', ['orders' => $orders]);
    }


    public function show(Order $order)
    {
        return view('orders', compact('order'));
    }
}
