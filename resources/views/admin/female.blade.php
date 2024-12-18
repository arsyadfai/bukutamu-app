<!-- resources/views/admin/statistics.blade.php -->
@extends('components.app-layout')

@section('content')
            <div class="container-fluid px-4">
                <h1 class="mt-4">Data Tamu Perempuan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Buku Tamu BBPMP Jateng</li>
                </ol>
    <!-- Guests Table -->
    <div class="table-container">
        <h5 class="mt-4">Daftar Tamu Perempuan</h5>
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
            @foreach($femaleGuests as $index => $guest)
                @if($guest->jenis_kelamin === 'Perempuan')
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
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    <div id="pagination" class="pagination"></div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="assets/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
@endsection
