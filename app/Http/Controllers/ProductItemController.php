<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductItemController extends Controller
{
    public function show(Product $product)
    {
        return view('.ProductItem', compact('product'));
    }
}
