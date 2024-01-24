<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Router>
 */
class RouterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'      => fake()->firstName(),
            'hsname'    => fake()->company(),
            'dnsname'   => fake()->domainName(),
            'username'  => fake()->userName(),
            'password'  => fake()->password(),
        ];
    }
}
