<?php

namespace App\Http\Controllers;

use App\Models\Favourites;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FavouritesController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();

        $categories = $this->fetchCategories();

        if ($user) {
            $productService = new ProductService();
            $favourites = $productService->getProducts($request, $user->id, true);

            if ($user->favourites()->count() > 0) {
                return Inertia::render('Products', ['products' => $favourites, 'categories' => $categories, 'mode' => 'favourites']);
            } else {
                return Inertia::render('Favourites', ['loggedIn' => true]);
            }
        }
        return Inertia::render('Favourites', ['loggedIn' => false]);
    }

    public function favouriteOrNot(Request $request)
    {
        $productId = $request->input('productId');
        $user = Auth::user();

        $favourite = $user->favourites()->where('product_id', $productId)->first();

        $message = "";

        if ($favourite) {
            $favourite->delete();
            $message = "removed from favourites";
        } else {
            $user->favourites()->create(['product_id' => $productId]);
            $message = "added to favourites";
        }

        Inertia::render('Products');
    }

    private function fetchCategories()
    {
        return ProductCategory::select('category_name', 'id')->get();
    }
}
