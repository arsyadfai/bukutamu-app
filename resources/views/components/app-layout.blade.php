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
    </style>
</head>
<body class="sb-nav-fixed">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

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
