<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyTask>
 */
class DailyTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'user_id' => 20,
            ];
    }

    public function completed(): static
    {
      return $this->state(fn (array $attributes) => ['completed' => true,]);
//      return $this->state(fn (array $attributes) => ['email_verified_at' => null,]);
    }
}
