<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BasketService
{
    public function addProductsToSession($productId, $quantity = null)
    {
        $basket = session()->get('basket', []);
        $message = null;

        if ($productId) {
            $product = Product::find($productId);

            if (isset($basket[$productId])) {
                $newQuantity = $quantity ?? $basket[$productId]['quantity'] + 1;


                if ($newQuantity > $product->stock_quantity) {
                    $message = "All available products in bag";
                } elseif ($newQuantity > 10) {
                    $message = 'Maximum of 10 of each product.';
                } else {
                    $basket[$productId]['quantity'] = $newQuantity;
                    $message = 'Quantity updated successfully.';
                }
            } else {
                $basket[$productId] = [
                    'product_id' => $productId,
                    'product_name' => $product->product_name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image_url' => $product->image_url,
                    'stock' => $product->stock_quantity,
                ];
                session()->put('basket', $basket);
                $message = 'Product successfully added to basket.';
            }
        }

        session()->put('basket', $basket);


        return response()->json(['success' => true, 'basket' => $basket[$productId], 'message' => $message]);
    }


    public function removeProductsFromSession($productId = null)
    {

        if ($productId) {
            session()->forget('basket.' . $productId);
        }

        return response()->json(['success' => true, 'basket' => session()->get('basket')]);
    }


    public function addUserProduct($productId, $userId, $newQuantity = null)
    {

        $basket = Basket::firstOrCreate(['user_id' => $userId], ['user_id' => $userId]);

        $existingItem = $basket->items()->where('product_id', $productId)->first();

        if ($existingItem) {
            $product = Product::where('id', $productId)->first();
            $stock = $product->stock_quantity;

            $newQuantity = $newQuantity ?? $existingItem->quantity + 1;
            if ($newQuantity <= $stock && $newQuantity <= 10) {
                $existingItem->quantity = $newQuantity;
                $basket->items()->save($existingItem);
            }
        } else {
            $basketItem = new BasketItem(['product_id' => $productId, 'quantity' => 1]);
            $basket->items()->save($basketItem);
        }



        return Inertia::render("Product");
    }
    public function removeUserProduct($productId, $userId)
    {
        if ($userId) {
            $basket = Basket::where('user_id', $userId)->first();
        }

        if ($basket) {
            $basket->items()->where('product_id', $productId)->delete();
        }

        return;
    }


    public function emptyBasket()
    {
        if (Auth::check()) {
            $user = Auth::user()->id;
            Basket::where('user_id', $user)->delete();
        }
        session()->put('basket', []);
    }
    public function guestToUser($basket)
    {
        $user = Auth::id();

        $basket = Basket::firstOrCreate(['user_id' => $user], ['user_id' => $user]);
        $items = $basket->items()->select('product_id', 'quantity')->get()->toArray();

        $this->mergeBaskets($items, $user, $basket);
    }

    public function mergeBaskets($userProducts, $user, $basket)
    {
        $basket = $basket ?? [];

        foreach ($userProducts as $item) {
            $productId = $item['product_id'];
            $userQuantity = $item['quantity'];

            $product = Product::find($productId);
            if (!$product) {
                continue;
            }

            $maxQuantity = min($product->stock_quantity, 10);

            if (isset($basket[$productId])) {
                $newQuantity = $basket[$productId]['quantity'] + $userQuantity;
                $basket[$productId]['quantity'] = min($newQuantity, $maxQuantity);
            } else {
                $basket[$productId] = [
                    'product_id'    => $productId,
                    'product_name'  => $product->product_name,
                    'description'   => $product->description,
                    'price'         => $product->price,
                    'quantity'      => min($userQuantity, $maxQuantity),
                    'image_url'     => $product->image_url,
                    'stock'         => $product->stock_quantity,
                ];
            }
        }

        foreach ($basket as $productId => $productInfo) {
            $this->addUserProduct($productId, $user, $productInfo['quantity']);
        }

        session()->put('basket', $basket);
    }
}
