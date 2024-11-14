<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>beranda - Buku Tamu Digital BBPMP Jateng</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Lora:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    </head>
<body class="index-body">
<x-header />

<div class="alert-container">
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
            <!-- Input Nama -->
            <div class="form-group">
                <input type="text" class="form-control" name="name" required placeholder=" ">
                <label for="name"><i class="fas fa-user"></i> Nama</label>
            </div>

            <!-- Input Alamat -->
            <div class="form-group">
                <input type="text" class="form-control" name="alamat" required placeholder=" ">
                <label for="alamat"><i class="fas fa-map-marker-alt"></i> Alamat</label>
            </div>

            <!-- Input Nomor Telepon -->
            <div class="form-group">
                <input type="text" class="form-control" name="nope" required placeholder=" ">
                <label for="nope"><i class="fas fa-phone"></i> Nomor Telepon</label>
            </div>

            <!-- Input Jenis Kelamin -->
            <div class="form-group">
                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="" disabled selected></option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <label for="jenis_kelamin"><i class="fas fa-venus-mars"></i> Jenis Kelamin</label>
            </div>

            <!-- Input Asal Instansi -->
            <div class="form-group">
                <input type="text" class="form-control" name="asal_instansi" required placeholder=" ">
                <label for="asal_instansi"><i class="fas fa-building"></i> Asal Instansi</label>
            </div>

            <!-- Input Bertemu Dengan -->
            <div class="form-group">
                <input type="text" class="form-control" name="bertemu" required placeholder=" ">
                <label for="bertemu"><i class="fas fa-users"></i> Bertemu Dengan Siapa</label>
            </div>

            <!-- Input Keperluan -->
            <div class="form-group">
                <textarea class="form-control" name="keperluan" required placeholder=" "></textarea>
                <label for="keperluan"><i class="fas fa-comment"></i> Keperluan</label>
            </div>


            <!-- Kamera -->
            <div class="form-group">
                <label for="photo"></label>
                <div id="camera" style="display: none;"></div> <!-- Menyembunyikan elemen kamera -->
                <input type="hidden" name="photo" id="photo">
            </div>
            <button type="submit" class="buton">Kirim</button>
        </form>
          <!-- Link Menuju Dashboard Admin -->
          <div class="text-right mt-3">
            <a href="/admin" class="text-primary" style="font-size: 0.8rem;">Dashboard Admin</a>
        </div>
    </div>
</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Menghilangkan teks label saat memilih jenis kelamin
    const jenisKelaminSelect = document.getElementById('jenis_kelamin');
    const jenisKelaminLabel = document.querySelector('label[for="jenis_kelamin"]');

    jenisKelaminSelect.addEventListener('change', function() {
        jenisKelaminLabel.style.display = 'none'; // Menyembunyikan label
    });


    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#camera');

    document.getElementById('guestbookForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.querySelector('.buton');
        btn.innerHTML = 'Loading...';
        btn.disabled = true;

        Webcam.snap(function(data_uri) {
            document.getElementById('photo').value = data_uri;
            e.target.submit();
        });
    });

    window.history.pushState(null, '', window.location.href);
    window.onpopstate = function () {
        window.location.href = "{{ route('home') }}";
    };
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
