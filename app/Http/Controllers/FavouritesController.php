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
        $favourites = session()->get('favourites');

        return view('Favourites', compact('favourites'));
    }

    public function favouriteOrNot($productId)
    {
        $user = Auth::user();

        $favourite = $user->favourites()->where('product_id', $productId)->first();

        $message = "";

        if ($favourite) {
            $favourite->delete();
            $message = "removed from favourites";
        } else {
            $user->favourites()->create(['product_id' => $productId]);
            $message = "added to favourites";
        }

        return redirect()->route('favourite.index')->with("info", $message);
    }

    public function sessionFavourites()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $favourites = $user->favourites()->with('product')->get()->pluck('product');

            session()->put('favourites', $favourites);
        }
    }
}
