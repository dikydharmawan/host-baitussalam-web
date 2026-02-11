<div class="containerHeader">
    <div class="searchBarHearder bg-success-subtle">
        <div class="headerchild container-fluid d-flex flex-row align-items-center ">
            <div class="navbarTop">
                <x-Navbar></x-Navbar>
            </div>
           <div class="Logo d-flex align-items-center">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('assets/images/logobaitussalam.png') }}" class="logo-img" alt="Logo">
    </a>
</div>

            <div class="ms-auto">
                <div id="signInContainer">

                    @auth
                        {{-- Kalau sudah login --}}
                        <div class="dropdown">
                            <button class="btn btn-signin d-flex align-items-center gap-2 dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                                <span class="fw-semibold">
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
            {{-- <div class="fotoProfileContainer ms-auto">
                <a href="">
                    <img class="rounded-circle m-3" src="{{ asset('assets/images/fotoProfile.jpg') }}" alt="fotoProfile" width="50"
            height="50">
            </a>
        </div> --}}
        </div>
    </div>
    <div class="navbar1">
        <x-Navbar></x-Navbar>
    </div>

</div>
