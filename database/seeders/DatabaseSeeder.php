<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Feedback;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Product Categories
        ProductCategory::factory()->count(5)->create();
        // Seed products
        Product::factory()->count(30)->create();

        User::factory()->count(10)->create();

        Review::factory()->count(100)->create();

        Feedback::factory()->count(10)->create();

        /*DB::table('admins')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin'), // Hash the password
            'first_name' => 'admin',
            'last_name' => 'admin',
        ]);*/
    }
}
