<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Review;

class ReviewCreated
{
    use Dispatchable, SerializesModels;

    public $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }
}
