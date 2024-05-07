<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turno>
 */
class TurnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'sector_id' => fake()->numberBetween(1, 5),
            'numero' => fake()->numberBetween(001, 100),
            'letra' => fake()->numberBetween(001, 100),
            'active' => true,
        ];
    }
}
