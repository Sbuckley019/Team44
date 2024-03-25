<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminProductController extends Controller
{
    public function create()
    {
        $categories = ProductCategory::all();

        return Inertia::render('Admin/Product', ['categories' => $categories]);
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
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imagePath = null;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('images/products'), $imageName);
                $imagePath = 'images/products/' . $imageName;
            } else {
                $imagePath = ''; // Default path or handling if no image is uploaded
            }

            Product::create([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'stock_quantity' => $request->stock_quantity,
                'image_url' => $imagePath,
            ]);

            return redirect()->route('products.create')->with('success', 'Product added to database');
        } catch (QueryException $exception) {


            return redirect()->route('home')->with('error', 'An error occurred while adding the product.' . $exception->getMessage());
        }
    }

    public function index()
    {
        $products = Product::with('orderItems')->get();

        $products->transform(function ($product) {
            $totalEarned = $product->orderItems->reduce(function ($total, $item) {
                return $total + ($item->subtotal * $item->quantity);
            }, 0);

            $totalEarned = number_format($totalEarned, 2, '.', '');

            return [
                'id' => $product->id,
                'image_url' => $product->image_url,
                'product_name' => $product->product_name,
                'description' => $product->description,
                'category_id' => $product->category_id,
                'stock_quantity' =>  $product->stock_quantity,
                'price' => $product->price,
                'sales' => $totalEarned,
                'discount' => $product->discount,
            ];
        });

        return Inertia::render('Admin/Products', ['products' => $products]);
    }

    public function applyDiscount(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|integer',
                'discount' => 'required|numeric',
            ]);

            $product = Product::findOrFail($request->input('product_id'));

            $product->update(['discount' => $request->input('discount')]);

            return response()->json([
                'message' => 'Discount applied successfully.',
                'product' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to apply discount',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function adminIndex(Request $request)
    {
        $query = Product::query();

        // To filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // To filter by price range if provided
        if ($request->has('priceRange') && $request->priceRange != '') {
            list($min, $max) = explode(' - ', $request->priceRange);
            $query->whereBetween('price', [(float)$min, (float)$max]);
        }

        $products = $query->orderBy('created_at', 'desc')->get();
        $categories = $this->fetchCategories(); // To ensure this method exists and fetches all categories

        return view('admin/products', compact('products', 'categories'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
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

        $products = Product::all();

        return Inertia::render('Admin/Products', [
            'products' => $products,
        ]);
    }
}
