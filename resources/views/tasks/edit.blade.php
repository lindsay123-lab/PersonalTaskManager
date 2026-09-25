<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        .buttons {
            margin-top: 20px;
        }

        button,
        a {
            padding: 10px 16px;
            border-radius: 6px;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #222;
            color: white;
        }

        a {
            background: #ddd;
            color: #222;
            margin-left: 5px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>✏️ Edit Task</h1>

    @if($errors->any())
        <div class="error">
            <strong>Please fix the following:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Task Name</label>
        <input
            type="text"
            name="task_name"
            value="{{ old('task_name', $task->task_name) }}"
            required
        >

        <label>Description</label>
        <textarea name="description">{{ old('description', $task->description) }}</textarea>

        <label>Status</label>
        <select name="status">
            <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>
                Completed
            </option>
        </select>

        <label>Due Date</label>
        <input
            type="date"
            name="due_date"
            value="{{ old('due_date', $task->due_date) }}"
        >

        <div class="buttons">
            <button type="submit">Update Task</button>

            <a href="{{ route('tasks.index') }}">
                Cancel
            </a>
        </div>

    </form>

</div>

</body>
</html> 
