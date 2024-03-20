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
        $favouriteIds = $this->fetchFavouriteIds();


        return view("Products", compact("products", "category", "categories", "favouriteIds", "sortChoice"));
    }

    private function sortProducts($products, $sortChoice)
    {
        switch ($sortChoice) {
            case 1:
                return $products->sortByDesc('price');
            case 2:
                return $products->sortBy('price');
            case 3:
                return $products->sortByDesc('rating');
            case 4:
                return $products->sortBy('created_at');
            default:
                return $products->sortByDesc('created_at');
        }
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view("createProduct", compact("categories"));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'stock_quantity' => 'required',
                'image_url' => 'required',
            ]);

            Product::create([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'stock_quantity' => $request->stock_quantity,
                'image_url' => $request->image_url,
            ]);

            return redirect()->route('products.create')->with('success', 'Product added to database');
        } catch (QueryException $exception) {


            return redirect()->route('home')->with('error', 'An error occurred while adding the product.' . $exception->getMessage());
        }
    }

    public function adminIndex()
    {
        $products = Product::all();

        return view('admin/products', compact('products'));
    }
    private function fetchFavouriteIds()
    {
        if (Auth::check()) {
            $user = auth()->user();
            return Favourites::where('user_id', $user->id)->pluck('product_id')->toArray();
        } else {
            return null;
        }
    }

    private function fetchCategories()
    {
        return ProductCategory::select('category_name', 'id')->get();
    }

    private function fetchCategoryById($id)
    {
        return ProductCategory::where('id', $id)->select('category_name', 'id')->first();
    }






    public function edit(Product $product)
    {
        $categories = $this->fetchCategories();
        return view('admin.editProduct', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:product_categories,id',
            'stock_quantity' => 'required|numeric',
            'image_url' => 'sometimes|url',
        ]);

        try {

            $product->update($request->only([
                'product_name',
                'description',
                'price',
                'category_id',
                'stock_quantity',
                'image_url',
            ]));


            return redirect()->route('products.adminIndex')->with('success', 'Product updated successfully');
        } catch (\Throwable $exception) {

            \Log::error("Error updating product: {$exception->getMessage()}");


            return redirect()->route('products.adminIndex')->with('error', 'An error occurred while updating the product.');
        }
    }



    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('products.adminIndex')->with('sucess', 'Product successfully removed from database');
    }
}
