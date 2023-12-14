<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $products = ProductCategory::all();
        return view("createProduct", compact("products"));
    }

    public function create()
    {
        return view("createProductCategory");
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'description' => 'required',
        ]);

        ProductCategory::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return redirect('/')->with('success', 'Product added to database');
    }
}
