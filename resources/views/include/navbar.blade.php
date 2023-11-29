<nav class="navbar sticky-top navbar-dark bg-dark navbar-expand-lg">
    <div class="container p-1">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse p-2" id="navbarToggler">
            <a class="navbar-brand text-light" href="{{ route('home') }}">
                <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo"
                    width="30" height="24" class="d-inline-block align-text-top">
                Banteran
            </a>

            <ul class="nav justify-content-center">
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

            <div>
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
                            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Halo, {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('riwayat-pesan') }}">Riwayat pesanan</a></li>
                                <li><a class="dropdown-item" id="btnLogout" href="javascript:void(0);"
                                        onclick="logout();">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                @endauth
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
