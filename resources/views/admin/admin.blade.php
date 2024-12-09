@extends('components.app-layout') <!-- Menggunakan layout utama -->

@section('content')
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
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
                            <a class="small text-white stretched-link" href="{{ route('admin.statistics') }}">View Details</a>
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
                <!-- Guests Table -->
                <div class="table-container">
                    <h5 class="mt-4">Daftar Kunjungan Hari ini</h5>
                    <div class="table-responsive">
                    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Gender</th>
                <th>Bertemu</th>
                <th>Keperluan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="guestTableBody">
            <!-- Isi tabel akan ditampilkan di sini -->
            @foreach($guests as $index => $guest)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($guest->photo && file_exists(public_path($guest->photo)))
                            <img src="{{ asset($guest->photo) }}" alt="Foto {{ $guest->name }}" width="80">
                        @else
                            <img src="{{ asset('path_to_placeholder_image.jpg') }}" alt="Foto Tidak Tersedia" width="80">
                        @endif
                    </td>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->alamat }}</td>
                    <td>{{ $guest->nope }}</td>
                    <td>{{ $guest->jenis_kelamin }}</td>
                    <td>{{ $guest->bertemu }}</td>
                    <td>{{ $guest->keperluan }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $guest->id) }}" class="btn-aksi btn-warning btn-sm">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </a>
                        <form action="{{ route('admin.destroy', $guest->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-aksi btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="pagination" class="pagination"></div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; BBPMP Jateng 2024</div>
                </div>
            </div>
        </footer>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    // Data untuk chart mingguan
    const weeklyLabels = @json($weeklyLabels);
    const weeklyData = @json($weeklyData);

    const ctx = document.getElementById('weeklyChart').getContext('2d');
    new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($weeklyLabels),  // Labels: Minggu 1, Minggu 2, dst
        datasets: [{
            label: 'Jumlah Kunjungan',
            data: @json($weeklyData),  // Data kunjungan per minggu
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

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
