<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Buku Tamu Digital BBPMP Jateng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background: #f5f6fa;
            font-family: 'Arial', sans-serif;
        }

        /* Sidebar styles */
        .sidebar {
            height: 100vh;
            background-color:  #6c757d;
            position: fixed;
            width: 250px;
            padding-top: 20px;
            color: white;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background-color: #675df9;
            color: #fff;
        }

        .sidebar .active {
            background-color: #675df9;
            color: white;
        }

        .container {
            margin-left: 270px;
            padding: 20px;
        }

        h1 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #4e3ef0;
        }

        .statistik h2 {
            background-color: #4e3ef0;
            color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .table thead th {
            background-color: #4e3ef0;
            color: #fff;
            font-weight: bold;
        }

        .table tbody tr:hover {
            background-color: rgba(78, 62, 240, 0.1);
        }

        .table tbody img {
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .table tbody img:hover {
            transform: scale(1.2);
        }

        .btn-warning {
            background-color: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background-color: #ffca2c;
            color: #000;
        }

        .btn-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>

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
        <h1 class="text-center">Dashboard Admin - Buku Tamu BBPMP Jateng</h1>

        <!-- Statistik -->
        <div class="statistik text-center mb-4">
            <h2>Total Tamu: {{ $totalGuests }}</h2>
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
                            <img src="{{ asset('uploads/guest_photos/' . $guest->foto) }}" alt="Foto {{ $guest->nama }}" style="width: 50px; height: 50px; object-fit: cover;">
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
