<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "price" => $this->faker->numberBetween(100, 1000),
            "discount_price" => $this->faker->numberBetween(100, 999),
            "discount_percent" => $this->faker->numberBetween(0, 100),
        ];
    }
}
