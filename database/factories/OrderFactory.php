<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => fake()->numberBetween(1, 10),
            "total_price" => fake()->numberBetween(10000, 100000),
            "payment_status" => fake()->randomElement(["pending", "paid"]),
            "order_status" => "waiting",
            "tracking_number" => mt_rand(100000000000, 999999999999),
            "shipping_id" => fake()->numberBetween(1, 5),
            "shipping_cost" => fake()->numberBetween(10000, 100000),
            "invoice_number" => fake()->numberBetween(100000000000, 999999999999),
            "coupon_id" => fake()->numberBetween(1, 10),
        ];
    }
}
