<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create New Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 16px;
            position: relative;
            /* To position close button inside */
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #aaa;
            text-decoration: none;
            transition: 0.3s;
        }

        .close-btn:hover {
            color: #000;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4 w-100" style="max-width: 600px;">
            <!-- Close Button (X) -->
            <a href="{{ route('tasks.index') }}" class="close-btn">&times;</a>

            <h2 class="text-center mb-4">Create New Task</h2>

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <!-- Select Admin -->
                <div class="mb-3">
                    <label for="admin_id" class="form-label">Admin</label>
                    <select id="admin_id" name="admin_id" class="form-select" required>
                        <option value="">Select Admin</option>
                        @foreach ($admins as $admin)
                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Task Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Task Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter task title"
                        required>
                </div>

                <!-- Task Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Task Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4"
                        placeholder="Enter task description" required></textarea>
                </div>

                <!-- Assigned User -->
                <div class="mb-3">
                    <label for="assigned_user_id" class="form-label">Assigned User</label>
                    <select id="assigned_user_id" name="assigned_user_id" class="form-select" required>
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
