<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function homeProductCarousels(Request $request)
    {
        $productService = new ProductService();
        $purchaseController = new PurchaseController();


        $bestSellingProducts = $purchaseController->bestSellingProducts();
        $newestProducts = $productService->getProducts(['sort' => 'newest'], null, false, 9);
        $mensProducts = $productService->getProducts(['category_id' => 1], null, false, 9);
        $womensProducts = $productService->getProducts(['category_id' => 2], null, false, 9);

        return Inertia::render('Home', [
            'BestSellingProducts' => $bestSellingProducts,
            'NewestProducts' => $newestProducts,
            'MensProducts' => $mensProducts,
            'WomensProducts' => $womensProducts,
        ]);
    }
}
