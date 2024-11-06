<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="{{ route('admin.index') }}">Buku Tamu BBPMP</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider" /></li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </ul>
        </li>
    </ul>
</nav>

<script>
    // Pencarian
    document.getElementById('btnNavbarSearch').addEventListener('click', function() {
        var searchTerm = document.querySelector('input[aria-label="Search for..."]').value;
        if(searchTerm) {
            alert('Mencari: ' + searchTerm);
            // Ganti alert ini dengan permintaan pencarian yang sesungguhnya
        }
    });

    // Mencegah pengguna mengakses halaman sebelumnya setelah logout
    window.addEventListener('load', function() {
        if (performance.navigation.type === 2) {
            // Jika pengguna mengakses halaman melalui cache atau tombol "Back", arahkan ke halaman home
            window.location.href = "{{ route('home') }}";
        }
    });

    // Tambahkan logika untuk cek cache saat halaman dimuat
    window.onpageshow = function(event) {
        if (event.persisted) {
            // Jika halaman dimuat ulang dari cache, arahkan ke halaman home
            window.location.href = "{{ route('home') }}";
        }
    };
</script>
