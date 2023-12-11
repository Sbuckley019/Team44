<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view("Products", compact("products"));
    }

    public function search(Request $request)
    {

        $searchTerm = $request->input('search');

        $products = Product::where("product_name", 'LIKE', "%$searchTerm")
            ->orWhere('category_id', 'LIKE', "%$searchTerm%")
            ->get();

        return view('Products', compact('products'));
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
            // Log the error or handle it in a way that makes sense for your application

            return redirect()->route('home')->with('error', 'An error occurred while adding the product.' . $exception->getMessage());
        }
    }
}
