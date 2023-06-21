<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3,true),
            'description' => fake()->paragraph,
            'user_id' => rand(1,9),
            'project_id' => rand(1,8),
            'category_id' => rand(1,9),
            'status_id' => rand(1,4),
        ];
    }
}
