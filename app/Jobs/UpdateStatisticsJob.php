<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Statistic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateStatisticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Clear the statistics table
        Statistic::truncate();

        // Get top 10 users based on tasks count
        $topUsers = User::withCount('tasks')
            ->orderByDesc('tasks_count')
            ->limit(10)
            ->get();

        // Insert data into statistics table
        foreach ($topUsers as $user) {
            Statistic::create([
                'user_id' => $user->id,
                'task_count' => $user->tasks_count
            ]);
        }
    }
}
