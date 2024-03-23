<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Feedback;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\ProductTableSeeder;


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
        //Product::factory()->count(100)->create();

        //$this->call(ProductTableSeeder::class);
        //$this->call(ProductTableSeeder::class);
        //$this->call(ProductTableSeeder::class);

        //User::factory()->count(10)->create();

        //Review::factory()->count(500)->create();

        //Feedback::factory()->count(10)->create();

        Admin::factory()->count(1)->create();
    }
}
