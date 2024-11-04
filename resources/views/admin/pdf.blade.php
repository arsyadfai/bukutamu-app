{{-- resources/views/admin/reports_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Tamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 50px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Laporan Data Tamu</h1>
    <h3>Periode: {{ $startDate }} s/d {{ $endDate }}</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Jenis Kelamin</th>
                <th>Bertemu</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $guest)
                <tr>
                    <td>{{ $guest->id }}</td>
                    <td>
                        @if($guest->photo && file_exists(public_path($guest->photo)))
                            <img src="{{ public_path($guest->photo) }}" alt="Foto {{ $guest->name }}">
                        @else
                            <span>Tidak Ada Foto</span>
                        @endif
                    </td>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->alamat }}</td>
                    <td>{{ $guest->nope }}</td>
                    <td>{{ $guest->jenis_kelamin }}</td>
                    <td>{{ $guest->bertemu }}</td>
                    <td>{{ $guest->keperluan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
