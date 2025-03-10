<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task Statistics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .stats-card {
            border-radius: 16px;
            transition: 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-center">Top 10 Users with Most Tasks</h2>
            <!-- زر الرجوع لقائمة المهام -->
            <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back to Task List</a>
        </div>

        <div class="card shadow-lg p-4 stats-card">
            <ul class="list-group list-group-flush">
                @forelse($topUsers as $stat)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="fw-bold">{{ $stat->user->name }}</span>
                    <span class="badge bg-success rounded-pill">{{ $stat->task_count }} Tasks</span>
                </li>
                @empty
                <li class="list-group-item text-center">No data available.</li>
                @endforelse
            </ul>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
