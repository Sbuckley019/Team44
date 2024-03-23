<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminProductController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin/orders', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('orders', compact('order'));
    }
}
