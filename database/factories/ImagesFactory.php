<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Images>
 */
class ImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "product_id" => fake()->numberBetween(1, 20),
            "path" => "product-images/knYYEpSRtfj5hj7MmaFXfS6kEx7uiclVeUg9Xm4a.webp",
        ];
    }
}
