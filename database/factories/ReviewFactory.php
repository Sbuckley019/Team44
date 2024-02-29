<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productIds = Product::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();


        return [
            'user_id' => $this->faker->randomElement($userIds),
            'product_id' => $this->faker->randomElement($productIds),
            'rating' => $this->faker->numberBetween(1, 5),
            'review_text' => $this->faker->paragraph(),
            'review_heading' => $this->faker->sentence,

        ];
    }
}
