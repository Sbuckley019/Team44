<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ReviewController extends Controller
{

    public function index($productName)
    {
        $productId = Product::where('product_name', $productName)->value('id');

        $reviews = Review::where('product_id', $productId)->with('user')->paginate(8);

        return $reviews;
    }

    public function create(Request $request)
    {

        $productId = $request->input('productId');
        if ($productId) {
            $product = Product::where('id', $productId)->first();

            if ($product) {
                return Inertia::render('Review', ['product' => $product]);
            }
        }
    }

    public function edit()
    {
        $user = Auth::id();

        $review = Review::where('user_id', $user)->first();
        $product = Product::where('id', $review->product_id)->first();

        return Inertia::render('Review', ['product' => $product, 'review' => $review]);
    }

    public function addReview(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'review_text' => 'required|string',
            'review_heading' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);


        try {
            Review::create($validated);
            return redirect()->route('home')->with('success', 'Feedback submitted successfully!');
        } catch (QueryException $exception) {
            return redirect()->back()->with('error', 'An error occurred while submitting your feedback. Please try again.');
        }
    }

    public function update(Request $request, $reviewId)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'review_text' => 'required|string',
            'review_heading' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        try {
            $review = Review::findOrFail($reviewId);
            $review->update($validated);

            return redirect()->route('home')->with('success', 'Review updated successfully!');
        } catch (QueryException $exception) {
            return redirect()->back()->with('error', 'An error occurred while updating your review. Please try again.');
        }
    }

    public function deleteReview()
    {
    }

    public function editReview()
    {
    }

    public function helpfulReview(Request $request)
    {
        $reviewId = $request->input('reviewId');


        $review = Review::where('id', $reviewId)->first();

        if ($review) {
            $review->increment('helpfulness');
        }
    }
}
