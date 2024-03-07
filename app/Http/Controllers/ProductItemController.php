<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductItemController extends Controller
{
    public function show(Product $product)
    {
        $reviewController = new ReviewController();
        $reviews = $reviewController->index($product->id);

        $purchaseController = new PurchaseController();
        $mostPurchased = $purchaseController->mostPurchasedInCategory($product);
        $alsoPurchased = $purchaseController->alsoPurchasedByUsers($product);

        return view('.ProductItem', compact('product', 'reviews', 'mostPurchased', 'alsoPurchased'));
    }
}
