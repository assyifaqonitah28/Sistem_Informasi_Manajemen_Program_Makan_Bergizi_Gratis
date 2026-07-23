<?php

namespace Database\Factories;

use App\Models\Distribution;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Distribution>
 */
class DistributionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'distribution_date' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'quantity' => fake()->numberBetween(1, 5),
            'status' => fake()->randomElement(['scheduled', 'distributed']),
            'notes' => fake()->sentence(),
        ];
    }
}
