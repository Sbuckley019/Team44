<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password123'), // You can use bcrypt() to hash passwords
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'email_verified_at' => now(), // Assuming you want to set the email verified at current time
            'remember_token' => Str::random(10), // Generate a random remember token
        ];
    }
}
