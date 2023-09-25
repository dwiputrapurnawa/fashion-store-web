<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'slug' => fake()->slug(),
            'price' => fake()->numberBetween(100000, 500000),
            'stock' => fake()->numberBetween(5, 20),
            'description' => fake()->paragraph(1),
            'category_id' => fake()->numberBetween(1,3),
        ];
    }
}
