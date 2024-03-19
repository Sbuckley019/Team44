<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;

class ReviewController extends Controller
{

    public function index($productId)
    {
        $reviews = Review::where('product_id', $productId)->with('user')->paginate(8);

        return $reviews;
    }

    public function addReview()
    {
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
