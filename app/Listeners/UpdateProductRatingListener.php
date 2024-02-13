<?php

namespace App\Listeners;

use App\Events\ReviewCreated;
use App\Models\Review;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateProductRatingListener implements ShouldQueue
{
    public function handle(ReviewCreated $event)
    {
        $review = $event->review;
        $product_id = $review->product_id;

        // Calculate the average rating for the product
        $rating = Review::where('product_id', $product_id)->avg('rating');

        // Update the product's average rating
        $review->product->update(['rating' => round($rating, 1)]);
    }
}
