<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Services\BasketService;
use App\Models\BasketItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BasketController extends Controller
{
    public function index()
    {
        $basket = session()->get('basket');

        return view('Basket', compact('basket'));
    }


    public function addOrUpdateProduct(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        $basketService = new BasketService();

        if (Auth::check()) {
            $user = Auth::user()->id;

            $basketService->addUserProduct($productId, $user, $quantity['quantity'] ?? null);
        }
        return $basketService->addProductsToSession($productId, $quantity['quantity'] ?? null);
    }


    public function removeProduct(Request $request)
    {

        $productId = $request->input('productId');
        $basketService = new BasketService();

        if (Auth::check()) {
            $user = auth()->user()->id;
            $basketService->removeUserProduct($productId, $user);
        }

        return $basketService->removeProductsFromSession($productId);
    }
}
