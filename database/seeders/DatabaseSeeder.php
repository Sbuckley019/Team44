<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;


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
    }
}
