@extends('components.app-layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Laporan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Buku Tamu BBPMP Jateng</li>
        </ol>

        <!-- Form Filter dan Pencarian -->
        <form method="GET" action="{{ route('admin.reports') }}" class="row g-3 mb-4">
            <!-- Filter Tanggal -->
            <div class="col-md-4">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>

            <!-- Pencarian Tamu (pindah ke kanan atas) -->
            <div class="col-md-4 mt-3 search-container">
                <label for="search" class="form-label">Cari Tamu</label>
                <div class="input-group">
                    <input type="text" id="search" name="search" class="form-control custom-search-box" placeholder="Cari tamu" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> <!-- Ikon pencarian -->
                    </button>
                </div>
            </div>
        </form>

        <!-- Export dan Table -->
        <div class="d-flex align-items-center mb-4">
            <!-- Form Export Laporan -->
            <form action="{{ route('admin.reports.export') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <button type="submit" name="file_type" value="excel_with_images" class="btn btn-success me-2">
                    <i class="bi bi-file-earmark-excel"></i> Download Excel
                </button>
            </form>
            <form action="{{ route('admin.reports.export') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <button type="submit" name="file_type" value="pdf" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i> Download PDF
                </button>
            </form>
        </div>

        <!-- Guests Table -->
        <div class="table-container">
            <h5 class="mt-4">Daftar Kunjungan</h5>
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

    <!-- Scripts -->
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
@endsection
