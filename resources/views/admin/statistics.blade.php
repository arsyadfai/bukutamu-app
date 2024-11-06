<!-- resources/views/admin/statistics.blade.php -->
@extends('components.app-layout')

@section('content')
            <div class="container-fluid px-4">
                <h1 class="mt-4">Statistik</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Buku Tamu BBPMP Jateng</li>
                </ol>
    <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Jumlah Pengunjung Laki-laki: {{ $maleCount }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('admin.male') }}">Lihat Selengkapnya</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary text-white mb-4">
                        <div class="card-body">Jumlah Pengunjung Perempuan: {{ $femaleCount }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('admin.female') }}">Lihat Selengkapnya</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Total Pengunjung: {{ $totalCount }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('admin.reports') }}">Lihat Selengkapnya</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Statistik Kunjungan Bulanan</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('admin.statistics') }}">Lihat Selengkapnya</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="row">
                    <!-- Weekly Statistics Chart -->
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-line me-1"></i>
                                Statistik Kunjungan Mingguan
                            </div>
                            <div class="card-body">
                                <canvas id="weeklyChart" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Statistics Chart -->
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Statistik Kunjungan Bulanan
                            </div>
                            <div class="card-body">
                                <canvas id="monthlyChart" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

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
    <script>
document.addEventListener("DOMContentLoaded", function () {
    // Data untuk chart mingguan
    const weeklyData = {
        labels: ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4"],
        datasets: [{
            label: "Kunjungan Mingguan",
            data: @json($weeklyStats),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            borderRadius: 5,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
            pointBorderColor: '#fff'
        }]
    };

    const weeklyConfig = {
        type: 'line',
        data: weeklyData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y;
                        }
                    }
                }
            }
        }
    };

    // Buat chart mingguan
    const weeklyChart = new Chart(
        document.getElementById('weeklyChart'),
        weeklyConfig
    );

    // Data untuk chart bulanan
    const monthlyData = {
        labels: @json($months),
        datasets: [{
            label: "Kunjungan Bulanan",
            data: @json($monthlyStats),
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 2,
            borderRadius: 5,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: 'rgba(153, 102, 255, 1)',
            pointBorderColor: '#fff'
        }]
    };

    const monthlyConfig = {
        type: 'bar',
        data: monthlyData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y;
                        }
                    }
                }
            }
        }
    };

    // Buat chart bulanan
    const monthlyChart = new Chart(
        document.getElementById('monthlyChart'),
        monthlyConfig
    );
});
</script>
</div>

@endsection
