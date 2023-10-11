@extends('layouts.main_template')

@section('content')

<div class="container-fluid mt-5 pt-2">
    <div class="card my-3">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('task_edit', ['task' => $task]) }}">Edit</a></li>
                        <li><a class="dropdown-item bg-danger fw-bold" href="{{ route('deactivate_task', ['id' => $task->id]) }}">Delete</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h2 class="card-title text-center">{{ $task->title }}</h2>
            <h6 class="card-title">Priority: {{ $task->priority }}</h6>
            <h6 class="card-title">Category: {{ $task->category }}</h6>
            <h6 class="card-title">Location: {{ $task->location }}</h6>
            <h6 class="card-title mt-4">Description:</h6>
            <p class="card-text">{{ $task->description }}</p>

            <form method="POST" action="{{ route('task.update-subtasks', ['id' => $task->id]) }}">
                @csrf
                <h4>Subtasks:</h4>
                <ul>
                    @foreach ($subtasks as $subtask)
                    <li>
                        <div class="form-check">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="subtask_checkbox[]"
                                value="{{ $subtask->id }}"
                                {{ $subtask->status ? 'checked' : '' }}
                            >
                            <label class="form-check-label {{ $subtask->status ? 'text-success' : '' }}">
                                {{ $subtask->subtask }}
                            </label>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <button type="submit" class="btn btn-primary">Update subtask</button>
            </form>

        </div>

        
    </div>
    @if (session('status') == 'updated')
    <div class="alert alert-success" role="alert">
        Task updated successfully
    </div>

    @elseif (session('status') == 'error')
    <div class="alert alert-alert" role="alert">
        Error
    </div>
    @endif
    
    
</div>

@endsection
