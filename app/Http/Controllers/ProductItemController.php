<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductItemController extends Controller
{
    public function show($product_id = null)
    {
        if ($product_id) {
            $productService = new ProductService();
            $product = $productService->getProduct($product_id);

            $reviewController = new ReviewController();
            $reviews = $reviewController->index($product_id);


            if ($product) {
                $purchaseController = new PurchaseController();
                $mostPurchased = $purchaseController->mostPurchasedInCategory($product);
                $alsoPurchased = $purchaseController->alsoPurchasedByUsers($product);
                return Inertia::render('Product', [
                    'product' => $product,
                    'reviews' => $reviews,
                    'mostPurchased' => $mostPurchased,
                    'alsoPurchased' => $alsoPurchased,
                ]);
            } else {
                dd("uh oh spegghetios");
            }
        }
        return redirect();
    }
}
