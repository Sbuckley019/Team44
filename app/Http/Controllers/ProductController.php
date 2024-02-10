<?php

namespace App\Http\Controllers;

use App\Models\Favourites;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function index($id = null)
    {
        $products = $id
            ? Product::where('category_id', $id)->get()
            : Product::all();

        $category = $id
            ? ProductCategory::where('id', $id)->select('category_name')->first()
            : null;


        if (Auth::check()) {
            $user = auth()->user();
            $favouriteIds = Favourites::where('user_id', $user->id)->pluck('product_id')->toArray();
        } else {
            $favouriteIds = null;
        }


        $category_name = $category ? $category->category_name : null;

        $categories = ProductCategory::select('category_name')->get();
        return view("Products", compact("products", "category_name", "categories", "favouriteIds"));
    }

    public function search(Request $request)
    {

        $searchTerm = $request->input('search');

        $category_name = $request->input("category_name");

        $category = ProductCategory::where('category_name', $category_name)->first();

        $category_id = $category ? $category->id : null;


        $products = Product::where("product_name", 'LIKE', "%$searchTerm%")
            ->where(function ($query) use ($category_id) {
                if ($category_id !== null) {
                    $query->where("category_id", $category_id);
                }
            })
            ->get();


        $categories = ProductCategory::select('category_name')->get();

        return view("Products", compact("products", "category_name", "categories"));
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
    /*
    public function filter($category_id = null, $low_price = null, $high_price = null)
    {
        $products = Product::where(function ($query) use ($category_id) {
            if ($category_id !== null) {
                $query->where("category_id", $category_id);
            }
        })->where(function ($query) use ($low_price) {
            if ($low_price !== null) {
                $query->where("category_id", $low_price);
            }
        })->where(function ($query) use ($category_id) {
            if ($category_id !== null) {
                $query->where("category_id", $category_id);
            }
        })->get();



        $category_name = $category ? $category->category_name : null;

        $categories = ProductCategory::select('category_name')->get();
        return view("Products", compact("products", "category_name", "categories"));
    }
    */
}
