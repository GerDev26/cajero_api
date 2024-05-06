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
        $letter = ['CAJ', 'ATE', 'INF', 'INV'];
        return [
            'user_id' => User::factory(),
            'letter' => fake()->randomElement($letter),
            'number' => fake()->numberBetween(001, 100),
            'active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
