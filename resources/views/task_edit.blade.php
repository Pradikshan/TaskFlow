@extends('layouts.main_template')

@section('content')

<div class="container-fluid">
    <div class="card my-4 border-0 rounded-4 shadow-lg">
    <div class="card-body  rounded-4">
        <h2 class="my-4">Update task details</h2>
    
        <form method="POST" action="{{ route('task_update', ['task' => $task]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="my-5">
                <label for="title" class="form-label text-dark fw-bold">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $task->title }}" required>
            </div>

            <div class="my-5">
                <label for="category" class="form-label text-dark fw-bold">Category</label>
                <input type="text" class="form-control" name="category" value="{{ $task->category }}" required>
            </div>

            <div class="my-5">
                <label for="description" class="form-label text-dark fw-bold">Description</label>
                <input type="text" class="form-control" name="description" value="{{ $task->description }}" required>
            </div>

            <div class="my-5">
                <label for="subtasks" class="form-label text-dark fw-bold">Subtasks</label>
                <ul id="subtasks">
                    @foreach ($task->subtasks as $subtask)
                        <li>
                            <input type="text" name="subtasks[]" class="form-control" placeholder="Subtask" value="{{ $subtask->subtask }}">
                            <input type="hidden" name="subtask_ids[]" value="{{ $subtask->id }}">
                        </li>
                    @endforeach
                </ul>
                <button type="button" id="addSubtask" class="btn btn-outline-primary btn-sm">Add subtask</button>
            </div>





            <div class="my-5">
                <label for="task_description" class="form-label text-dark fw-bold" >Priority</label>
                <select name="priority" id="priority" class="form-control" required>
                    <option value="High" {{ $task->priority == 'High' ? 'selected' : '' }}>High</option>
                    <option value="Medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>


            <!-- <div class="my-5">
                <label for="location" class="form-label text-dark fw-bold" value="{{ $task->location }}">Location</label>
                <input type="text" class="form-control" name="location" id="locationInput" required>
                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="getLocationButton">Get Current Location</button>
            </div>



            <div class="mb-5">
                <label for="due_date" class="form-label text-dark fw-bold" value="{{ $task->due_date }}">Due date</label>
                <input class=" mx-4" type="date" name="due_date" min="{{ now()->addDay()->format('Y-m-d') }}">
            </div> -->

            <div class="my-5">
                <label for="location" class="form-label text-dark fw-bold">Location</label>
                <input type="text" class="form-control" name="location" id="locationInput" value="{{ $task->location }}" required>
                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="getLocationButton">Get Current Location</button>
            </div>

            <div class="mb-5">
                <label for="due_date" class="form-label text-dark fw-bold">Due date</label>
                <input class="mx-4" type="date" name="due_date" min="{{ now()->addDay()->format('Y-m-d') }}" value="{{ $task->due_date }}">
            </div>


            <div class="d-grid col-2 mx-auto">
                <button type="submit" class="btn btn-outline-primary btn-md mt-3">Save changes</button>
            </div>
        </form>
    </div>
    </div>
</div>


@endsection