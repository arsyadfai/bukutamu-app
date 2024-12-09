<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Buku Tamu Digital BBPMP Jateng</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="/assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        /* Remove margin and padding from body */
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevent horizontal overflow */
        }

        /* Ensure the main content fills the width */
        #layoutSidenav_content {
            width: 100%; /* Full width */
        }

        .container-fluid {
            padding: 0; /* Remove padding */
            width: 100%; /* Full width */
        }

        table {
            width: 100%; /* Make table full width */
            table-layout: fixed; /* Make columns fixed width */
        }

        /* Gaya untuk Notifikasi Pop-up */
.alert-container {
    font-family: Arial, sans-serif;
    position: fixed;
    top: 20px;
    left: 55%;
    transform: translateX(-50%);
    z-index: 9999; /* Pastikan di atas elemen lainnya */
    width: 50%; /* Agar pop-up tidak melebar */
    max-width: 500px; /* Lebar maksimal */
    padding: 15px 20px; /* Padding di dalam alert */
    border-radius: 5px; /* Membuat sudut membulat */
    animation: slideDown 0.8s forwards, fadeOut 1s 2.5s forwards; /* Animasi */
}
.alert {
    position: fixed; /* Menjaga pop-up tetap pada posisi yang sama di layar */
    top: 20px; /* Berada di bagian atas layar */
    left: 45%;
    transform: translateX(-50%); /* Pusatkan secara horizontal */
    opacity: 0;
    z-index: 9999; /* Pastikan alert berada di atas semua elemen */
    padding: 15px 20px; /* Padding di dalam alert */
    border-radius: 5px; /* Membuat sudut membulat */
    animation: slideDown 0.8s forwards, fadeOut 1s 4.5s forwards; /* Animasi */
}

/* Animasi slide turun */
@keyframes slideDown {
    from {
        top: -100px; /* Mulai di luar layar */
        opacity: 0;
    }
    to {
        top: 20px; /* Berakhir di bagian atas layar */
        opacity: 1;
    }
}

/* Animasi fade out */
@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
        top: -100px; /* Kembali ke luar layar */
    }
}

    </style>
</head>
<body class="sb-nav-fixed">
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

    <x-navbar />

    <x-sidebar />
    
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                @yield('content') <!-- Konten halaman akan disisipkan di sini -->
            </div>
        </main>
        
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">&copy; BBPMP Jateng 2024</div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript Libraries and Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/demo/chart-area-demo.js"></script>
    <script src="/assets/demo/chart-bar-demo.js"></script>
    <script src="/js/datatables-simple-demo.js"></script>
</body>
</html>
