<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Buku Tamu Digital BBPMP Jateng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Custom CSS -->
  
</head>
<body class="admin-body">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>BBPMP Jateng</h2>
        <a href="#" class="active">Data Tamu</a>
        <a href="#">Pengaturan</a>
        <a href="#">Laporan</a>
        <a href="#">Statistik</a>
    </div>

    <!-- Content -->
    <div class="container">
    <h1 class="text-center dashboard-title">Dashboard Admin - Buku Tamu BBPMP Jateng</h1>


        <!-- Statistik -->
        <div class="statistik text-center mb-4">
            <h2>Total Tamu: {{ $guests->count() }}</h2>
        </div>

        <!-- Tabel data tamu -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Jenis Kelamin</th>
                        <th>Bertemu Dengan</th>
                        <th>Keperluan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guests as $index => $guest)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($guest->photo && file_exists(public_path($guest->photo)))
                                <img src="{{ asset($guest->photo) }}" alt="Foto {{ $guest->name }}">
                            @else
                                <img src="{{ asset('path_to_placeholder_image.jpg') }}" alt="Foto Tidak Tersedia"> <!-- Ganti dengan gambar placeholder -->
                            @endif
                        </td>
                        <td>{{ $guest->name }}</td>
                        <td>{{ $guest->alamat }}</td>
                        <td>{{ $guest->nope }}</td>
                        <td>{{ $guest->jenis_kelamin }}</td>
                        <td>{{ $guest->bertemu }}</td>
                        <td>{{ $guest->keperluan }}</td>
                        <td>
                            <a href="{{ route('admin.edit', $guest->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.destroy', $guest->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
