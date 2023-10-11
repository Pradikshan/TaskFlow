@extends('layouts.main_template')

@section('content')

<div class="container-fluid mt-5 pt-2">

    @foreach ($incompleteTasks as $taskItem)
    
    
    <a href="/task_detail/{{ $taskItem->id }}" style="text-decoration: none;">
    <div class="card my-5">
        <div class="card-header">
            <h5 class="card-title">{{ $taskItem->title }}</h5>
        </div>
        <div class="card-body">
            <h6 class="card-title">Category: {{ $taskItem->category }}</h6>
            <p class="card-text">{{ $taskItem->description }}</p>
        </div>
        <div class="card-footer">
            <div class="d-flex flex-wrap">
                <h6 class="card-subtitle mb-2 text-body-secondary">Tags: </h6>
                <span class="badge mx-1 mb-2 badge-color">{{ $taskItem->priority }} priority</span>
                <span class="badge text-bg-primary mx-1 mb-2" id="badge-location">Location: {{ $taskItem->location }}</span>
                
            </div>
            <div class="d-flex mt-2">
                <span class="badge text-bg-success mx-1 mb-2">Created on: {{ $taskItem->created_at->format('d M') }}</span>
                <span class="badge text-bg-warning mx-1 mb-2">Due date: {{ \Carbon\Carbon::parse($taskItem->due_date)->format('d M') }}</span>
            </div>
            <div class="progress" role="progressbar" aria-label="progress-bar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" data-task-id="{{ $taskItem->id }}">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width: 0%"></div>
            </div>
        </div>
    </div>
    </a>
 
    <script>
        @php
            $totalSubtasks = $taskItem->subtasks->count();
            $completedSubtasks = $taskItem->subtasks->where('status', true)->count();
        @endphp
        document.addEventListener("DOMContentLoaded", function () {
            const taskProgressBar = document.querySelector('[data-task-id="{{ $taskItem->id }}"]');
            
            if (taskProgressBar) {
                const totalSubtasks = {{ $totalSubtasks }};
                const completedSubtasks = {{ $completedSubtasks }};
                
                const percentageCompleted = (completedSubtasks / totalSubtasks) * 100;
                
                taskProgressBar.setAttribute('aria-valuenow', percentageCompleted);
                
                const progressBarElement = taskProgressBar.querySelector('.progress-bar');
                progressBarElement.style.width = percentageCompleted + '%';
                
                if (percentageCompleted <= 25) {
                    progressBarElement.classList.remove('bg-warning');
                    progressBarElement.classList.add('bg-danger');
                } else if (percentageCompleted <= 50) {
                    progressBarElement.classList.remove('bg-danger');
                    progressBarElement.classList.add('bg-info');
                } else if (percentageCompleted <= 75) {
                    progressBarElement.classList.remove('bg-info');
                    progressBarElement.classList.add('bg-warning');
                } else {
                    progressBarElement.classList.remove('bg-warning');
                    progressBarElement.classList.add('bg-success');
                }
            }
        });
    </script>
    @endforeach

    <div class="d-flex justify-content-end align-items-end fixed-bottom my-4 mx-4">
        <a class="nav-link active" aria-current="page" href="{{ url('/create_task') }}"><span><i class="fa-solid fa-plus fa-2xl"></i></span></a>
    </div>

</div>

@if (session('status') == 'updated')
<div class="alert alert-success" role="alert">
    Task updated successfully
</div>

@elseif (session('status') == 'deleted')
<div class="alert alert-warning" role="alert">
    Task deleted successfully
</div>

@elseif (session('status') == 'error')
<div class="alert alert-alert" role="alert">
    Error
</div>
@endif

@endsection
