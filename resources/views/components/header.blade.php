<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="/home">
        <img src="../assets/img/logo3.png" alt="Logo" style="height: 40px;"> <!-- Logo -->
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item {{ request()->routeIs('home.page') ? 'active' : '' }}">
    <a class="nav-link" href="/home"><i class="fas fa-home nav-icon"></i>Beranda</a>
</li>
<li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
    <a class="nav-link" href="/about"><i class="fas fa-info-circle nav-icon"></i>Tentang</a>
</li>
<li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                <a class="nav-link" href="/contact"><i class="fas fa-envelope nav-icon"></i>Kontak</a> <!-- Ikon Kontak -->
            </li>
            @auth
                <!-- Tombol Logout dengan konfirmasi -->
                <li class="nav-item">
                    <a class="btn buton-login" href="{{ route('logout') }}" onclick="event.preventDefault(); confirmLogout();" role="button">Logout</a>
                    <!-- Form Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @else
                <!-- Tombol Login jika belum login -->
                <li class="nav-item">
                    <a class="btn buton-login" href="/login" role="button">Login</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<!-- Tambahkan skrip konfirmasi logout -->
<script>
    function confirmLogout() {
        if (confirm("Apakah Anda yakin ingin logout?")) {
            document.getElementById('logout-form').submit(); // Submit form logout jika "Ya"
        }
    }
</script>
