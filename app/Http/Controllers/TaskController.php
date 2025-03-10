<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateStatisticsJob;
use App\Models\Statistic;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['admin', 'assignedUser'])
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $admins = User::where('role', 'admin')->get();
        $users = User::where('role', '!=', 'admin')->get();
        return view('tasks.create', compact('admins', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'admin_id'         => 'required|exists:users,id',
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'assigned_user_id' => 'required|exists:users,id',
        ]);

        Task::create($request->all());

        UpdateStatisticsJob::dispatch();

        return redirect()->route('tasks.index');
    }

    public function statistics()
    {
        $topUsers = Statistic::with('user')
            ->having('task_count', '>', 0)
            ->orderByDesc('task_count')
            ->limit(10)
            ->get();

        return view('tasks.statistics', compact('topUsers'));
    }
}
