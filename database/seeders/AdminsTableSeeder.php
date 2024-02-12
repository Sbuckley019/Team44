<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin'), // Hash the password
            'first_name' => 'admin',
            'last_name' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}