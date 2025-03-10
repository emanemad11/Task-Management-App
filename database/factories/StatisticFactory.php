<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistic>
 */
class StatisticFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'task_count' => $this->faker->numberBetween(1, 20),
        ];
    }
}
