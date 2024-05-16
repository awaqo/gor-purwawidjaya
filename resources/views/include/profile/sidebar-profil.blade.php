<div class="col-12 col-md-4 col-lg-4">
    <div class="d-flex flex-column gap-2">
        <div class="col pe-3">
            <a href="{{ url('profil/' . Auth::user()->id) }}"
                class="{{ request()->is('profil/*') ? 'profile-menu-active' : '' }} profile-menu d-flex flex-row gap-3 text-decoration-none text-color-primary poppins-bold">
                <div>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div>Profil</div>
            </a>
        </div>
        <div class="col pe-3">
            <a href="{{ route('riwayat-pesan') }}"
                class="{{ request()->is('riwayat-pesanan') ? 'profile-menu-active' : '' }} profile-menu d-flex flex-row gap-3 text-decoration-none text-color-primary poppins-bold">
                <div>
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <div>Transaksi Pembelian</div>
            </a>
        </div>
        <div class="col pe-3">
            <a class="d-flex flex-row gap-3 text-decoration-none btn-logout poppins-bold" id="btnlogout" href="javascript:void(0);">
                <div>
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <div>Keluar</div>
            </a>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const targetUrl = '{{ route('logout') }}';
        const sideOut = document.querySelector("#btnlogout");
        sideOut.addEventListener("click", () => {
            Swal.fire({
                icon: "question",
                text: "Yakin ingin logout?",
                showCancelButton: true,
                confirmButtonText: "Yakin",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(targetUrl);
                }
            });
        });
    </script>
@endpush
