<div class="row">
        <div class="col-md-12">
            <h3>Daftar Tamu Bulanan</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Jumlah Tamu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($months as $index => $month)
                        <tr>
                            <td>{{ $month }}</td>
                            <td>{{ $monthlyStats[$index] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('monthlyStatsChart').getContext('2d');
    const monthlyStats = @json($monthlyStats);
    const months = @json($months);

    const monthlyStatsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Jumlah Tamu',
                data: monthlyStats,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
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
@endsection
