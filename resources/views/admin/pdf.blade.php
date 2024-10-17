<!DOCTYPE html>
<html>
<head>
    <title>Daftar Tamu</title>
    <style>
        /* Tambahkan gaya CSS yang diperlukan untuk PDF */
    </style>
</head>
<body>
    <h1>Daftar Tamu</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Nomor Telepon</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Asal Instansi</th>
                <th>Keperluan</th>
                <th>Bertemu</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $guest)
                <tr>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->nope }}</td>
                    <td>{{ $guest->jenis_kelamin }}</td>
                    <td>{{ $guest->alamat }}</td>
                    <td>{{ $guest->asal_instansi }}</td>
                    <td>{{ $guest->keperluan }}</td>
                    <td>{{ $guest->bertemu }}</td>
                    <td><img src="{{ asset($guest->photo) }}" width="50" alt="Foto"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
