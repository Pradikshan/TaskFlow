@extends('layouts.main_template')

@section('content')

<div class="container-fluid">
    <h2 class="text-start fw-bold pt-5 mt-5">Task Analytics</h2>

    <div class="mt-5 d-flex justify-content-center" style="width: 50%;">
        <canvas id="myChart"></canvas>
    </div>

    

    <script>
        const ctx = document.getElementById('myChart');
        const data = @json($completedSubtasks);

        const dates = data.map(item => {
            const date = new Date(item.date);
            return date.toLocaleDateString('en-US', { day: 'numeric', month: 'short' });
        });

        const counts = data.map(item => item.count);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'No. of Subtasks Completed',
                    data: counts,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</div>

@endsection