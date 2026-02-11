<div class="containerHeader">
    <div class="searchBarHearder bg-success-subtle">
        <div class="headerchild container-fluid d-flex flex-row align-items-center py-2 px-lg-5">
            
            {{-- Hamburger menu for mobile (Left) --}}
            <div class="d-lg-none me-2">
                <x-navbar></x-navbar>
            </div>

            <div class="Logo">
                <a class="navbar-brand m-0" href="/">
                    <img src="{{ asset('assets/images/logobaitussalam.png') }}" alt="Logo Baitussalam" class="logo-img"
    style="width: 60px !important; max-width: 60px !important; height: auto !important;">
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
                            <i class="bi bi-person-circle fs-5"></i>
                            <span class="fw-semibold d-none d-sm-inline">
                                {{ Auth::user()->name }}
                            </span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- Kalau belum login --}}
                    <button class="btn btn-signin d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#signin">
                        <span class="fw-bold small text-uppercase" style="font-size: 12px;">SIGN IN</span>
                        <div class="icon-circle">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </button>
                @endauth
            </div>
        </div>
    </div>
</div>            {{-- <div class="fotoProfileContainer ms-auto">
                <a href="">
                    <img class="rounded-circle m-3" src="{{ asset('assets/images/fotoProfile.jpg') }}" alt="fotoProfile" width="50"
            height="50">
            </a>
    </div>
    <div class="navbar1">
        <x-Navbar></x-Navbar>
    </div>

</div>
