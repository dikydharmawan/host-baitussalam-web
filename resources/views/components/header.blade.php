<div class="containerHeader">
    <div class="searchBarHearder bg-success-subtle">
        <div class="headerchild container-fluid d-flex flex-row align-items-center">

            {{-- Hamburger menu for mobile (Left) --}}
            <div class="d-lg-none me-2">
                <x-navbar></x-navbar>
            </div>

            <div class="Logo">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('assets/images/logobaitussalam.png') }}" class="logo-img" alt="BaitussalamLogo">
                </a>
            </div>

            {{-- Desktop Navbar (Center) --}}
            <div class="d-none d-lg-flex grow justify-content-center">
                <x-navbar></x-navbar>
            </div>

            <div id="signInContainer" class="ms-auto d-flex align-items-center">
                @auth
                    {{-- Kalau sudah login --}}
                    <div class="dropdown">
                        <button class="btn btn-signin d-flex align-items-center gap-2 dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <span class="fw-semibold d-none d-sm-inline">
                                {{ Auth::user()->name }}
                            </span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- Kalau belum login --}}
                    <button class="btn btn-signin d-flex align-items-center gap-2" data-bs-toggle="modal"
                        data-bs-target="#signin">
                        <span class="fw-semibold">SIGN IN</span>
                        <span class="icon-circle">
                            <i class="bi bi-arrow-right"></i>
                        </span>
                    </button>
                @endauth
            </div>
        </div>
    </div>
</div>
