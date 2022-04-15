<x-admin-master>
@section('content')
<h1 class="h3 mb-4 text-gray-800">Dash board</h1>
<script src="{{ asset('chart.js/chart.js') }}"></script>
<canvas id="myChart" class="responsive"></canvas>
<script>
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Posts', 'Categories', 'Comments', 'Users'],
        datasets: [{
            label: 'Count',
            data: [{{$postsCount}}, {{$categoriesCount}}, {{$commentsCount}}, {{$usersCount}},],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
            ],
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

@endsection


</x-admin-master>