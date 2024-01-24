<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Server>
 */
class ServerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'          => fake()->name(),
            'ip'            => fake()->ipv4(),
            'domain'        => fake()->domainName(),
            'netwatch'      => fake()->ipv4(),
            'username'      => fake()->userName(),
            'password'      => encrypt(fake()->password()),
            'location'      => fake()->locale(),
            'is_active'     => fake()->randomElement(['yes', 'no']),
            'is_available'  => fake()->randomElement(['yes', 'no']),
            'price'         => fake()->numberBetween(10000, 100000),
            // 'type'      => fake()->randomElement(['free', 'paid']),
            // 'api'       => fake()->randomElement(['active', 'nonactive']),
        ];
    }
}
