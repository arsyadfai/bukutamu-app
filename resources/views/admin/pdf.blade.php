<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengunjung Buku Tamu</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Laporan Pengunjung Buku Tamu BBPMP Jateng</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Gender</th>
                <th>Bertemu</th>
                <th>Keperluan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $index => $guest)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->alamat }}</td>
                <td>{{ $guest->nope }}</td>
                <td>{{ $guest->jenis_kelamin }}</td>
                <td>{{ $guest->bertemu }}</td>
                <td>{{ $guest->keperluan }}</td>
                <td>{{ $guest->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
