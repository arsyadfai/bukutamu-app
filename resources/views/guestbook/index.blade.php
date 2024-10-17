<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form | Buku Tamu Digital</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="index-body">
<x-header />
<div class="alert-container">
        <!-- Notification Pop-up -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="form-container">
        <div class="form-box">
            <h2 class="text-center">BUKU TAMU DIGITAL</h2>
            <p class="text-center">BBPMP Jateng</p>
            <form id="guestbookForm" action="{{ route('guestbook.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name" required placeholder=" ">
                    <label for="name"><i class="fas fa-user"></i> Nama</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="nope" required placeholder=" ">
                    <label for="nope"><i class="fas fa-phone"></i> Nomor Telepon</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="asal_instansi" required placeholder=" ">
                    <label for="asal_instansi"><i class="fas fa-building"></i> Asal Instansi</label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="keperluan" required placeholder=" "></textarea>
                    <label for="keperluan"><i class="fas fa-comment"></i> Keperluan</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="bertemu" required placeholder=" ">
                    <label for="bertemu"><i class="fas fa-users"></i> Bertemu Dengan Siapa</label>
                </div>

                <div class="form-group">
                    <label for="photo"></label>
                    <div id="camera" style="display: none;"></div> <!-- Menyembunyikan elemen kamera -->
                    <input type="hidden" name="photo" id="photo">
                </div>
                <button type="submit" class="buton">Kirim</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inisialisasi webcam
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#camera'); // Melampirkan webcam ke elemen dengan ID "camera"

        // Capture foto saat form disubmit
        document.getElementById('guestbookForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah submit form
            
            // Menampilkan indikator loading
            const btn = document.querySelector('.buton'); // Menggunakan nama kelas yang benar
            btn.innerHTML = 'Loading...'; // Mengubah teks tombol
            btn.disabled = true; // Menonaktifkan tombol

            Webcam.snap(function(data_uri) {
                document.getElementById('photo').value = data_uri; // Simpan foto ke input tersembunyi
                e.target.submit(); // Kirim form setelah capture
            });
        });

          // Mencegah kembali ke halaman login setelah login
    window.history.pushState(null, '', window.location.href);
    window.onpopstate = function () {
        window.location.href = "{{ route('home') }}"; // Redirect ke halaman home
    };
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
