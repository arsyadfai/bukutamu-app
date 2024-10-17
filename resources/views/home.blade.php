<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Beranda - Buku Tamu Digital BBPMP Jateng</title>
</head>
<body class="home-body">
<x-header />
<!-- Hero Section with Background Image -->
<div class="hero-section">
    <div class="text-wrapper">
        <img src="../assets/img/logo2.png" style="width: 200px;" alt="Logo">
        <h1>Selamat Datang di BBPMP Jateng</h1>
        <p>Halaman ini merupakan tempat untuk meninggalkan pesan dan pendapat Anda mengenai layanan kami.</p>
        <p>Silakan klik tombol di bawah ini untuk mengisi Buku Tamu.</p>
        
        <!-- Kode auth untuk mengecek apakah pengguna sudah login -->
        @auth
            <!-- Jika pengguna sudah login -->
            <a href="{{ route('guestbook.index') }}" class="btn btn-success btn-lg">Isi Buku Tamu</a>
        @else
            <!-- Jika pengguna belum login -->
            <a href="/login" class="btn btn-success btn-lg">Isi Buku Tamu</a>
        @endauth
    </div>
</div>
<x-footer />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
