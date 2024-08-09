<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LongTermTask>
 */
class LongTermTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'user_id' => User::factory(),
            'date' => now()->addDays(rand(1, 30)),
        ];
    }

    public function expired(): static
    {
        return $this->state(fn (array $attributes) => ['date' => now()->subDays(rand(1, 30)),]);
    }
}
