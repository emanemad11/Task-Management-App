<?php

namespace Tests\Feature;

use App\Jobs\UpdateStatisticsJob;
use App\Models\Task;
use App\Models\User;
use App\Models\Statistic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /** @test */
    public function it_can_create_a_task_and_dispatch_statistics_job()
    {
        // Prevent actual job from running, but track if dispatched
        Bus::fake();

        // Create admin and user
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);

        // Task data
        $taskData = [
            'admin_id' => $admin->id,
            'title' => 'Test Task Title',
            'description' => 'Test Task Description',
            'assigned_user_id' => $user->id,
        ];

        // Hit the store route
        $response = $this->withoutMiddleware()->post(route('tasks.store'), $taskData);

        // Assert redirect to task index page
        $response->assertRedirect(route('tasks.index'));

        // Assert task is in database
        $this->assertDatabaseHas('tasks', [
            'admin_id' => $admin->id,
            'assigned_user_id' => $user->id,
            'title' => 'Test Task Title',
            'description' => 'Test Task Description',
        ]);

        // Assert job was dispatched
        Bus::assertDispatched(UpdateStatisticsJob::class);
    }

    /** @test */
    public function it_shows_top_10_users_with_most_tasks()
    {
        // Create 15 users
        $users = User::factory()->count(15)->create(['role' => 'user']);

        // Give first 10 users random number of tasks
        foreach ($users->take(10) as $user) {
            Task::factory()->count(rand(1, 5))->create([
                'assigned_user_id' => $user->id,
                'admin_id' => User::factory()->create(['role' => 'admin'])->id
            ]);

            // Create statistic manually to simulate updated stats
            Statistic::factory()->create([
                'user_id' => $user->id,
                'task_count' => Task::where('assigned_user_id', $user->id)->count()
            ]);
        }

        // Call statistics page
        $response = $this->get(route('statistics'));

        // Assert view is loaded correctly
        $response->assertStatus(200);

        // Check that top 10 users are passed to view
        $response->assertViewHas('topUsers', function ($topUsers) {
            return count($topUsers) === 10;
        });
    }
}
