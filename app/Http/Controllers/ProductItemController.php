<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductItemController extends Controller
{
    public function show($product_name = null)
    {
        if ($product_name) {
            $productService = new ProductService();
            $product = $productService->getProduct($product_name);

            $reviewController = new ReviewController();
            $reviews = $reviewController->index($product_name);

            if (Auth::check()) {
                $user = Auth::user();
                $product = Product::where('product_name', $product_name)->first();

                if (
                    $product &&
                    $user->purchases()->where('product_id', $product->id)->exists() &&
                    !$user->reviews()->where('product_id', $product->id)->exists()
                ) {
                    $canReview = true;
                }
            }




            if ($product) {
                $purchaseController = new PurchaseController();
                $mostPurchased = $purchaseController->mostPurchasedInCategory($product);
                $alsoPurchased = $purchaseController->alsoPurchasedByUsers($product);
                return Inertia::render('Product', [
                    'product' => $product,
                    'reviews' => $reviews,
                    'mostPurchased' => $mostPurchased,
                    'alsoPurchased' => $alsoPurchased,
                    'canReview' => $canReview ?? false,
                ]);
            } else {
                dd("uh oh spegghetios");
            }
        }
        return redirect();
    }
}
