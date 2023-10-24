<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'telegram_token'    => encrypt(fake()->password()),
            'telegram_bot_name' => fake()->userName(),
            'telegram_group_id' => fake()->numberBetween(5674, 546456546),
        ];
    }
}
