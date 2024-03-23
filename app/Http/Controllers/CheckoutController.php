<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Basket;
use App\Models\BasketItem;
use App\Services\BasketService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function validateShipping(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required_if:user,null|email|max:255',
            'address' => 'required|string|max:255',
            'shipping_method' => 'required|in:free,next_day',
        ]);
    }
    public function validatePayment(Request $request)
    {
        $validatedData = $request->validate([
            'card_number' => 'required|string|max:20',
            'expiry_date' => 'required|string|max:10',
            'cvv' => 'required||string|max:3',

        ]);
    }

    public function checkout(Request $request)
    {

        $request->validate([
            'basket.*.product_id' => 'required|integer|exists:products,id',
            'basket.*.quantity' => 'required|integer|min:1',
            'shippingDetails.email' => 'required|email',
        ]);

        $products = $request->input('basket');
        $email = $request->input('shippingDetails.email');

        $basketService = new BasketService();
        $productService = new ProductService();

        DB::beginTransaction();

        try {
            $totalPrice = 0;

            foreach ($products as $product) {
                $productData = $productService->findProductById($product['product_id']);
                if (!$productData || !$productService->checkAvailability($product['product_id'], $product['quantity'])) {
                    throw new \Exception("Product with ID {$product['product_id']} is not available in the desired quantity or does not exist.");
                }

                // Calculate the subtotal for each product based on the server-side price
                $subtotal = $product['quantity'] * $productData->price;
                $totalPrice += $subtotal;
            }

            $orderData = [
                'email' => $email,
                'total_price' => $totalPrice, // Calculate total price server-side
                'status' => 'pending',
            ];

            if (Auth::check()) {
                $orderData['user_id'] = Auth::id();
            }

            $order = Order::create($orderData);

            foreach ($products as $product) {
                $productData = $productService->findProductById($product['product_id']);
                $order->orderItems()->create([
                    'product_id' => $productData->id,
                    'quantity' => $product['quantity'],
                    'subtotal' => $product['quantity'] * $productData->price,
                ]);
            }

            $order->save();

            $basketService->emptyBasket();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
