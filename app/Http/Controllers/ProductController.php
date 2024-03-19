<?php

namespace App\Http\Controllers;

use App\Models\Favourites;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Review;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $productService = new ProductService();
        $products = $productService->getProducts($request, $userId);

        $category_id = $request->category_id;
        $category = $category_id ? $this->fetchCategoryById($category_id) : null;
        $categories = $this->fetchCategories();

        return Inertia::render('Products', [
            'products' => $products,
            'category' => $category,
        ]);
    }

    private function fetchCategories()
    {
        return ProductCategory::select('category_name', 'id')->get();
    }

    private function fetchCategoryById($id)
    {
        return ProductCategory::where('id', $id)->select('category_name', 'id', 'description')->first();
    }
}
