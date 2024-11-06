<div id="layoutSidenav">
        <div id="layoutSidenav_nav" class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="{{ route('admin.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="{{ route('admin.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-person"></i></div>
                        User Profile
                    </a>
                    <a class="nav-link" href="{{ route('guestbook.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                        Register Tamu
                    </a>
                    <a class="nav-link" href="{{ route('admin.statistics') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Statistik
                    </a>
                    <a class="nav-link" href="{{ route('admin.reports') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Laporan
                    </a>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link"><i class="fas fa-cog"></i></div>
                        Pengaturan
                    </a>
                </div>
                <!-- Tambahkan gambar animasi di sini -->
            <div class="sidebar-animation">
            <img src="{{ asset('assets/img/animation.png') }}" alt="Animasi" class="sidebar-animation-img">
            </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                BBPMP Jateng
            </div>
        </div>