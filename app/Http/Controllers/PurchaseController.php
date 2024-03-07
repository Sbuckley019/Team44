<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function mostPurchasedInCategory(Product $product)
    {
        return $this->getPurchasedProducts(Product::query()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->withCount('purchases')
            ->orderByDesc('purchases_count'), $product);
    }

    public function alsoPurchasedByUsers(Product $product)
    {
        // Get user IDs who purchased the given product
        $userIds = $product->purchases()->pluck('user_id');

        // Get products that were purchased by those users, excluding the given product
        return $this->getPurchasedProducts(Product::whereHas('purchases', function ($query) use ($userIds) {
            $query->whereIn('user_id', $userIds);
        })->where('id', '!=', $product->id)->withCount('purchases')->orderByDesc('purchases_count'), $product);
    }

    private function getPurchasedProducts($query, $product)
    {
        $products = $query->take(9)->get();

        if ($products->count() < 9) {
            $additionalProducts = Product::whereNotIn('id', $products->pluck('id')->toArray())
                ->where('id', '!=', $product->id)
                ->take(9 - $products->count())
                ->get();
            $products = $products->merge($additionalProducts);
        }

        return $products;
    }
}
