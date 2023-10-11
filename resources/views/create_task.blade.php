@extends('layouts.main_template')

@section('content')

<div class="container-fluid">
    <div class="card my-4 border-0 rounded-4 shadow-lg">
    <div class="card-body  rounded-4">
        <h2 class="my-4">Create new task</h2>
    
        <form method="POST" action="\create_task" enctype="multipart/form-data">
            @csrf
            <div class="my-5">
                <label for="title" class="form-label text-dark fw-bold">Title</label>
                <input type="text" class="form-control" name="title" required>
            </div>

            <div class="my-5">
                <label for="category" class="form-label text-dark fw-bold">Category</label>
                <input type="text" class="form-control" name="category" required>
            </div>

            <div class="my-5">
                <label for="description" class="form-label text-dark fw-bold">Description</label>
                <input type="text" class="form-control" name="description" required>
            </div>

            <div class="my-5">
                <label for="subtasks" class="form-label text-dark fw-bold">Subtasks</label>
                <ul id="subtasks">
                    <li>
                        <input type="text" name="subtasks[]" class="form-control" placeholder="Subtask">
                    </li>
                </ul>
                <button type="button" id="addSubtask" class="btn btn-outline-primary btn-sm">Add new subtask</button>
            </div>

            <div class="my-5">
                <label for="task_description" class="form-label text-dark fw-bold">Priority</label>
                <select name="priority" id="priority" class="form-control" required>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>

            <div class="my-5">
                <label for="location" class="form-label text-dark fw-bold">Location</label>
                <input type="text" class="form-control" name="location" id="locationInput" required>
                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="getLocationButton">Get Current Location</button>
            </div>

            <div class="mb-5">
                <label for="due_date" class="form-label text-dark fw-bold ">Due date</label>
                <input class=" mx-4" type="date" name="due_date" min="{{ now()->addDay()->format('Y-m-d') }}">
            </div>

            <div class="d-grid col-2 mx-auto">
                <button type="submit" class="btn btn-outline-primary btn-md mt-3">Add new task</button>
            </div>
        </form>
    </div>
    </div>

    @if (session('status') == 'success')
    <div class="alert alert-success" role="alert">
        New task created successfully
    </div>

    @elseif (session('status') == 'error')
    <div class="alert alert-alert" role="alert">
        Error
    </div>
    @endif
</div>


@endsection