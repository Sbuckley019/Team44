<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view("createProduct", compact("products"));
    }

    public function create()
    {
        return view("createProduct");
    }

    public function store(Request $request)
    {
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

        return redirect()->route('createProduct')->with('success', 'Product added to database');
    }
}
