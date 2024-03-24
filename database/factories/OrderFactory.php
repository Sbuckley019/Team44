<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order; // Adjust the path if your models are located elsewhere


class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Assuming User factory exists and is properly set up.
            'email' => $this->faker->safeEmail, // Using Faker to generate a safe email.
            'order_date' => $this->faker->date(), // Using Faker to generate a date.
            'total_price' => $this->faker->randomFloat(2, 10, 1000), // Random price between 10 and 1000.
            'status' => $this->faker->randomElement(['pending', 'shipped', 'delivered']), // Random order status.
            'created_at' => now(), // Current timestamp.
            'updated_at' => now(), // Current timestamp.
        ];
    }
}