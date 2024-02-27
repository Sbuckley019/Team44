<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB; 


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'product_name' => 'Example Product 1',
                'description' => 'This is an example product description 1.',
                'price' => 99.99,
                'category_id' => 1, 
                'stock_quantity' => 50,
                'image_url' => 'register_background.jpg',
                
            ],
            [
                'product_name' => 'Example Product 2',
                'description' => 'This is an example product description 2.',
                'price' => 199.99,
                'category_id' => 2, 
                'stock_quantity' => 30,
                'image_url' => 'star-full.jpg',
                
            ],
            
        ]);
    }
}
