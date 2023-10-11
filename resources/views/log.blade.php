@extends('layouts.main_template')

@section('content')

<div class="container-fluid mt-5 pt-2">
    <h2>Completed tasks log</h2>

    @foreach ($completedTasks as $task)
    <a href="/task_detail/{{ $task->id }}" style="text-decoration: none;">
    <div class="card my-5">
        <div class="card-header">
            <h5 class="card-title">{{ $task->title }}</h5>
        </div>
        <div class="card-body">
            <h6 class="card-title">Category: {{ $task->category }}</h6>
            <p class="card-text">{{ $task->description }}</p>
        </div>
        <div class="card-footer">
            <div class="d-flex">
                <h6 class="card-subtitle mb-2 text-body-secondary">Tags: </h6>
                <span class="badge mx-1 mb-2 badge-color">{{ $task->priority }} priority</span>
                <span class="badge text-bg-primary mx-1 mb-2" id="badge-location">Location: {{ $task->location }}</span>
            </div>
            <div class="progress" role="progressbar" aria-label="progress-bar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" data-task-id="{{ $task->id }}">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 100%"></div>
            </div>
        </div>
    </div>
    </a>
    
   
    @endforeach

    <div class="d-flex justify-content-end align-items-end fixed-bottom my-4 mx-4">
        <a class="nav-link active" aria-current="page" href="{{ url('/create_task') }}"><span><i class="fa-solid fa-plus fa-2xl"></i></span></a>
    </div>

</div>

@endsection
