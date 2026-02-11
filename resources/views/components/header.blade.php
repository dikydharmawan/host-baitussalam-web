<div class="containerHeader">
    <div class="searchBarHearder bg-success-subtle">
        <div class="headerchild container-fluid d-flex flex-row align-items-center justify-content-between">
            <div class="Logo">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('assets/images/logobaitussalam.png') }}" alt="BaitussalamLogo" width="120"
                        height="96">
                </a>
            </div>

            <div class="d-flex align-items-center gap-2 gap-lg-4">
                <div class="d-none d-lg-block">
                    <x-navbar></x-navbar>
                </div>

                <div id="signInContainer" class="d-flex align-items-center gap-2">
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

                    {{-- Hamburger menu for mobile --}}
                    <div class="d-lg-none">
                        <x-navbar></x-navbar>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
