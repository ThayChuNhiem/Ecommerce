<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\shop;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        shop::factory()->create([
            'name' => 'Sample Shop',
            'address' => '123 Sample Street',
            'phone' => '123-456-7890',
            'email' => 'sample@example.com',
            'description' => 'This is a sample shop description.',
            'image' => 'sample.jpg',
            'status' => true,
            'owner' => 1,
        ]);
    }
}
