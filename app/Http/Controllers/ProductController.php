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
    public function refresh()
    {
        session()->forget('products');
        return $this->index(request());
    }
    public function index(Request $request)
    {
        $category_id = $request->category ?? $request->id;
        $searchTerm = $request->search;
        $sortChoice = $request->sortChoice;
        $rating = $request->rating;
        $min = $request->priceRangeMin;
        $max = $request->priceRangeMax;

        $products = session()->get('products');


        // If there are no previously stored products or if search term or category has changed, 
        // execute the query to fetch products
        if (!$products || $searchTerm || $category_id || $rating) {
            $productsQuery = Product::query();

            // Filter by category if category_id is provided
            if ($category_id) {
                $productsQuery->where('category_id', $category_id);
            }

            // Filter by search term if provided
            if ($searchTerm) {
                $productsQuery->where('product_name', 'LIKE', "%$searchTerm%");
            }

            if ($rating) {
                $productsQuery->where('rating', '>=', $rating);
            }
            if ($min) {
                $productsQuery->where('price', '>=', $min)
                    ->where('price', '<=', $max);
            }

            // Retrieve products based on the updated query
            $products = $productsQuery->get();

            // Store the filtered products in the session
            session()->put('products', $products);
            session()->put('category_id', $category_id);
        }

        $products = $this->sortProducts($products, $sortChoice);

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
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imagePath = null;

            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();  
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

         /* SULTAN
         I changed the code little bit. But, kept initial work for review
       
         $categories = $this->fetchCategories(); */

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
    
        /* I changed the code little bit. But, kept initial work for review
        
        return redirect('products.adminIndex')->with('sucess', 'Product successfully removed from database'); 
        */
     
        // fetched the products again because one has been deleted
        $products = Product::all(); 
    
        // fetched also the categories
        $categories = $this->fetchCategories();
    
        // Returned the view with both products and categories
        return view('admin/products', compact('products', 'categories'));
    }

   
    











    
}
