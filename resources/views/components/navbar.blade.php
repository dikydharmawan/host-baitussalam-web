<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mobile-drawer" id="navbarNavDropdown">

            <button class="btn-close drawer-close d-lg-none" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown">
            </button>

            <ul class="navbar-nav mx-auto gap-4">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('beranda') }}">
                        <i class="bi bi-house nav-icon"></i>
                        <span>BERANDA</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('profile') }}">
                        <i class="bi bi-person nav-icon"></i>
                        <span>PROFILE</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('organisasi') }}">
                        <i class="bi bi-people nav-icon"></i>
                        <span>ORGANISASI</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('galeri') }}">
                        <i class="bi bi-image nav-icon"></i>
                        <span>GALERI</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-headset nav-icon"></i>
                        <span>LAYANAN</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('zakatinfaq') }}">Zakat & Infaq</a></li>
                        <li><a class="dropdown-item" href="{{ route('literasikeagamaan') }}">Literasi Keagamaan</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('peminjamanfasilitas') }}">Peminjaman
                                Fasilitas</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('kontak') }}">
                        <i class="bi bi-telephone nav-icon"></i>
                        <span>KONTAK</span>
                    </a>
                </li>

                <li class="searchBarMobile">
                    <x-search-bar></x-search-bar>
                </li>
            </ul>
        </div>
    </div>
</nav>
