<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    // Display a listing of the order items
    public function index()
    {
        $orderItems = OrderItem::all();
        return view('order_items.index', ['orderItems' => $orderItems]);
    }

    // Display the specified order item
    public function show(OrderItem $orderItem)
    {
        return view('order_items.show', ['orderItem' => $orderItem]);
    }

    // Return products from a specific order
    public function getProductsFromOrder($orderId)
    {
        $orderItems = OrderItem::where('order_id', $orderId)->with('product')->get();
        return view('order_items.order_products', ['orderItems' => $orderItems]);
    }

    // Display order status
    public function displayStatus($orderId)
    {
        $orderItem = OrderItem::where('order_id', $orderId)->first();
        $status = $orderItem->order->status;
        return view('order_items.order_status', ['status' => $status]);
    }
    
    // Other methods for create, store, edit, update, destroy can be added as per your requirement
}