<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationUser>
 */
class NotificationUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_read' => fake()->randomElement(['yes', 'no']),
            'is_send' => fake()->randomElement(['yes', 'no']),
        ];
    }
}
