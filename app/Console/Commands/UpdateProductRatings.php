<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Console\Command;

class UpdateProductRatings extends Command
{
    protected $signature = 'update:product-ratings';

    protected $description = 'Update product ratings based on reviews';

    public function handle()
    {
        // Query reviews and calculate average rating for each product
        $products = Product::all();

        foreach ($products as $product) {
            $rating = Review::where('product_id', $product->id)->avg('rating');
            $product->update(['rating' => round($rating, 1)]);
        }

        $this->info('Product ratings updated successfully.');
    }
}
