<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .task-card {
            border-radius: 16px;
            transition: 0.3s;
        }

        .task-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-center">Task List</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('statistics') }}" class="btn btn-success">View Statistics</a>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>
            </div>
        </div>

        <div class="row g-4">
            @forelse($tasks as $task)
            <div class="col-md-6">
                <div class="card task-card shadow-sm p-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="card-text text-muted">{{ $task->description }}</p>
                        <hr>
                        <p><strong>Assigned To:</strong> {{ optional($task->assignedUser)->name ?? 'Unknown' }}</p>
                        <p><strong>Admin:</strong> {{ optional($task->admin)->name ?? 'Unknown' }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No tasks found.
                </div>
            </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $tasks->links('pagination::bootstrap-5') }}
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
