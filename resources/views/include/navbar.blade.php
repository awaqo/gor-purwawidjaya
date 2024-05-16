{{-- 
    <nav class="navbar sticky-top navbar-dark bg-dark navbar-expand-lg">
        <div class="container p-3">
            <a class="navbar-brand text-light" href="{{ route('home') }}">
                GOR Purwawidjaya
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse p-2" id="navbarToggler">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Perlombaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Fasilitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Akademi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Testimoni</a>
                    </li>
                </ul>
    
                @guest
                    <div class="d-flex align-items-center gap-3">
                        <div>
                            <a class="text-white text-decoration-none" href="{{ route('login') }}">Masuk</a>
                        </div>
                        <div>
                            <a class="text-decoration-none btn btn-outline-light rounded-5 py-1 px-4"
                                href="{{ route('register') }}">Daftar</a>
                        </div>
                    </div>
                @endguest
    
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <button id="profile-dropdown" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Halo, {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="{{ route('riwayat-pesan') }}" id="riwayat-pesanan">Riwayat
                                        pesanan</a></li>
                                <li><a class="dropdown-item" id="btnLogout" href="javascript:void(0);"
                                        onclick="logout();">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
--}}

<nav id="navbar-sites" class="navbar navbar-expand-lg navbar-dark bg-navbar fixed-top">
    <div class="container">
        {{-- logo --}}
        <a class="navbar-brand lobster-regular fs-3" href="#" style="letter-spacing: 1px">Banteran</a>

        {{-- toggler btn --}}
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- sidebar --}}
        <div class="sidebar offcanvas offcanvas-end p-3" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            {{-- sidebar header --}}
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">GOR Purwawidjaya</h5>
                <button type="button" class="btn-close btn-close-white shadow-none border-0"
                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            {{-- sidebar body --}}
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link poppins-medium" href="/#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link poppins-medium" href="/#jadwal">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link poppins-medium {{ request()->is('info-perlombaan*') ? 'active' : '' }}"
                            href="{{ route('info-lomba') }}">Perlombaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link poppins-medium" href="/#fasilitas">Fasilitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link poppins-medium {{ request()->is('info-akademi*') ? 'active' : '' }}"
                            href="/#akademi">Akademi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link poppins-medium" href="/#testimoni">Testimoni</a>
                    </li>
                </ul>

                {{-- login-register --}}
                <div>
                    @guest
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <div>
                                <a class="text-white text-decoration-none" href="{{ route('login') }}">Masuk</a>
                            </div>
                            <div>
                                <a class="text-decoration-none btn btn-outline-light rounded-5 py-2 px-5"
                                    href="{{ route('register') }}">Daftar</a>
                            </div>
                        </div>
                    @endguest

                    @auth
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <button id="profile-dropdown"
                                    class="btn text-white border-0 lobster-regular fs-5 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="letter-spacing: 1px">
                                    Halo, {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-light px-2 py-4">
                                    <li class="mb-2">
                                        <a class="dropdown-item" href="{{ url('profil/' . Auth::user()->id) }}">
                                            <i class="fa-solid fa-user me-1"></i> Profil
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a class="dropdown-item" href="{{ route('riwayat-pesan') }}" id="riwayat-pesanan">
                                            <i class="fa-solid fa-receipt me-1"></i> Riwayat pesanan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" id="btnLogout" href="javascript:void(0);">
                                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        const url = '{{ route('logout') }}';
        const out = document.querySelector("#btnLogout");
        out.addEventListener("click", () => {
            Swal.fire({
                icon: "question",
                text: "Yakin ingin logout?",
                showCancelButton: true,
                confirmButtonText: "Yakin",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(url);
                }
            });
        });
    </script>
@endpush
