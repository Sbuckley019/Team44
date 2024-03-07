<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ReviewController extends Controller
{
    public function index($productId)
    {
        $reviews = Review::where('product_id', $productId)->with('user')->get();

        $perPage = 6;
        $page = request()->query('page', 1);

        $pagedData = $reviews->slice(($page - 1) * $perPage, $perPage)->all();

        $paginator = new LengthAwarePaginator($pagedData, $reviews->count(), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
        return $paginator;
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
            return 'review successfully incremented';
        }
    }
}
