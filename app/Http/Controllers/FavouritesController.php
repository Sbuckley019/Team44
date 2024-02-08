<?php

namespace App\Http\Controllers;

use App\Models\Favourites;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouritesController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // retrieves authenticated user instance
            $user = auth()->user();

            // Retrieve the product IDs associated with the user's favorites
            $productIds = Favourites::where('user_id', $user->id)->pluck('product_id')->toArray();

            // Retrieve all product data for the favorite product IDs
            $favourites = Product::whereIn('id', $productIds)->get();

            return view('Favourites', compact('favourites'));
        }
    }


    public function FavouriteOrNot($productId)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $favourite = Favourites::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();


            if ($favourite) {
                $favourite->delete();
            } else {
                Favourites::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                ]);
            }
        }
        return redirect()->route('favourite.index');
    }
}
