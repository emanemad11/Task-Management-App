<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'admin_id' => User::factory()->create(['role' => 'admin'])->id,
            'assigned_user_id' => User::factory()->create(['role' => 'user'])->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}
