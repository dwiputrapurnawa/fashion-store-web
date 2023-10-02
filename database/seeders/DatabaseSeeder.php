<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(10)->create();
        Product::factory(20)->create();
        Category::factory(3)->create();
        Wishlist::factory(10)->create();
        Rating::factory(50)->create();
        Comment::factory(100)->create();
        // Cart::factory(20)->create();
    }
}
