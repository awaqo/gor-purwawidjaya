<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a id="profile-dropdown" class="nav-link" data-toggle="dropdown" href="#">
                Halo, {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}
                <span>
                    <i class="fa-solid fa-angle-down"></i>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header fw-bold">GOR Purwawidjaya</span>
                <div class="dropdown-divider"></div>
                {{-- <li>
                    <a class="dropdown-item" href="#">
                        <i class="fa-solid fa-user mr-2"></i>Profil
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="{{ route('riwayat-pesan') }}">Riwayat pesanan</a></li>
                <div class="dropdown-divider"></div> --}}
                <li>
                    <a class="dropdown-item" id="btnLogout" href="javascript:void(0);">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

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