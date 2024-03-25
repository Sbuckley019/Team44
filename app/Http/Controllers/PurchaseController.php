<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function bestSellingProducts()
    {
        $productsWithPurchasesCount = Product::withCount('purchases')
            ->orderByDesc('purchases_count')
            ->take(9)
            ->get();

        $totalProductsNeeded = 9 - $productsWithPurchasesCount->count();

        if ($totalProductsNeeded > 0) {
            $additionalProducts = Product::whereNotIn('id', $productsWithPurchasesCount->pluck('id')->toArray())
                ->take($totalProductsNeeded)
                ->get();

            $productsWithPurchasesCount = $productsWithPurchasesCount->merge($additionalProducts);
        }

        return $productsWithPurchasesCount;
    }
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
        $userIds = $product->purchases()->pluck('user_id');


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
