<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vpn>
 */
class VpnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip'        => fake()->ipv4(),
            'username'  => fake()->userName(),
            'password'  => fake()->password(),
            'expired'   => fake()->date(),
            'is_active' => fake()->randomElement(['yes', 'no']),
            'is_trial'  => fake()->randomElement(['yes', 'no']),
        ];
    }
}
