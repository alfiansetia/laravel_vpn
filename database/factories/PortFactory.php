<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Port>
 */
class PortFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dst'   => fake()->numberBetween(1, 9) * 1000 + fake()->numberBetween(0, 999),
            'to'    => fake()->randomElement([80, 8291, 8728]),
        ];
    }
}
