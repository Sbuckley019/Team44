<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order; // Make sure the model is imported correctly

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::factory()->count(10)->create();
    }
}