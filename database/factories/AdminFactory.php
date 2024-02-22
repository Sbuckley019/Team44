<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Admin::class;
    public function definition(): array
    {
        return [
            'username' => 'admin',
            'password' => Hash::make('admin'), // Hash the password
            'first_name' => 'admin',
            'last_name' => 'admin',
        ];
    }
}
