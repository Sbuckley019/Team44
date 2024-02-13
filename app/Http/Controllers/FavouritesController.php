<?php

namespace App\Http\Controllers;

use App\Models\Favourites;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $favourites = $user->favourites()->with('product')->get();

            return view('Favourites', compact('favourites'));
        }
    }


    public function favouriteOrNot($productId)
    {
        $user = Auth::user();

        $favourite = $user->favourites()->where('product_id', $productId)->first();

        if ($favourite) {
            $favourite->delete();
        } else {
            $user->favourites()->create(['product_id' => $productId]);
        }

        return redirect()->route('favourite.index');
    }
}
