<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductCategory;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        $categoryIds = ProductCategory::pluck('id')->toArray();
        return [
            'product_name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'category_id' => $this->faker->randomElement($categoryIds),
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
