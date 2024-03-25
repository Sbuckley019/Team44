<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;


class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();


        $orders = Order::with(['user', 'orderItems'])
            ->orderBy('created_at', 'desc')
            ->get();


        $orders->transform(function ($order) {
            return [
                'id' => $order->id,
                'customer_name' => optional($order->user)->name,
                'total_price' => $order->total_price,
                'status' => $order->status,
                'date' => $order->created_at->toDateString(),
                'order_items_count' => $order->orderItems->count(),
            ];
        });

        return Inertia::render('Admin/Orders', ['orders' => $orders]);
    }


    public function show(Order $order)
    {

        $order->load('user', 'orderItems');
        return Inertia::render('Admin/DetailedOrder', ['order' => $order]);
    }

}