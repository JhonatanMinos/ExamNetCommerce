<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'user_id' => User::factory(),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'is_completed' => $this->faker->boolean(),
            'start_at' => $this->faker->dateTimeBetween('-10 days', 'now'),
            'expired_at' => $this->faker->dateTimeBetween('now', '+10 days')
        ];
    }
}
