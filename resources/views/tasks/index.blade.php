<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            color: #222;
        }

        .add-btn {
            display: inline-block;
            background: #222;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .task-card {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .task-card h3 {
            margin-top: 0;
        }

        .pending {
            color: #b7791f;
            font-weight: bold;
        }

        .completed {
            color: #2f855a;
            font-weight: bold;
        }

        .actions a,
        .actions button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            margin-right: 5px;
        }

        .edit {
            background: #e2e8f0;
            color: #222;
        }

        .delete {
            background: #c53030;
            color: white;
        }

        .empty {
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>📋 Personal Task Manager</h1>

    <a href="{{ route('tasks.create') }}" class="add-btn">
        + Add New Task
    </a>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @forelse($tasks as $task)

        <div class="task-card">

            <h3>{{ $task->task_name }}</h3>

            <p>
                {{ $task->description ?? 'No description provided.' }}
            </p>

            <p>
                <strong>Status:</strong>

                @if($task->status === 'Completed')
                    <span class="completed">Completed</span>
                @else
                    <span class="pending">Pending</span>
                @endif
            </p>

            <p>
                <strong>Due Date:</strong>
                {{ $task->due_date ?? 'No due date' }}
            </p>

            <div class="actions">

                <a href="{{ route('tasks.edit', $task) }}" class="edit">
                    Edit
                </a>

                <form action="{{ route('tasks.destroy', $task) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="delete">
                        Delete
                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="empty">
            <h3>No tasks yet!</h3>
            <p>Click "Add New Task" to create your first task.</p>
        </div>

    @endforelse

</div>

</body>
</html>
