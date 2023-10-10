<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Discount;
use App\Models\Images;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Shipping;
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

        $users = User::factory(10)->create();
        $products = Product::factory(20)->create();
        Category::factory(3)->create();
        Wishlist::factory(10)->create();
        // Rating::factory(20)->create();
        Comment::factory(100)->create();
        Discount::factory(5)->create();
        // Review::factory(20)->create();
        // Cart::factory(20)->create();
        Coupon::factory(10)->create();
        Order::factory(20)->hasAttached($products, ["quantity" => 5, "price_per_unit" => 50000])->create();
        Images::factory(30)->create();

        Shipping::factory()->create([
            "name" => "SiCepat"
        ]);

        Shipping::factory()->create([
            "name" => "JNE"
        ]);

        Shipping::factory()->create([
            "name" => "J&T"
        ]);

        Shipping::factory()->create([
            "name" => "Wahana"
        ]);

        Shipping::factory()->create([
            "name" => "Paxel"
        ]);
    }
}
