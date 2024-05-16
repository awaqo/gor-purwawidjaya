<footer class="mt-auto" style="background-color: #0B251C;">
    <div class="container py-5">
        <div class="d-flex flex-lg-row flex-md-column row-gap-5 flex-wrap px-3">
            <div class="col-12 col-md-12 col-lg-6">
                <div class="d-flex flex-column row-gap-4">
                    <div class="lobster-regular text-white" style="font-size: 32px; letter-spacing: 1px">Banteran</div>
                    {{-- Google Maps --}}
                    <div class="col-12 col-md-12 col-lg-8">
                        <div class="w-100 ratio ratio-21x9">
                            <iframe src="{{ $maps->source }}" style="border:0; border-radius: 12px;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    {{-- sosmed --}}
                    <div class="d-flex gap-4">
                        <a href="#" style="width: 32px; height: 32px">
                            <img src="{{ asset('assets/dist/icon/whatsapp.png') }}" class="img-fluid" alt="">
                        </a>
                        <a href="#" style="width: 32px; height: 32px">
                            <img src="{{ asset('assets/dist/icon/instagram.png') }}" class="img-fluid" alt="">
                        </a>
                        <a href="#" style="width: 32px; height: 32px">
                            <img src="{{ asset('assets/dist/icon/twitter.png') }}" class="img-fluid" alt="">
                        </a>
                        <a href="#" style="width: 32px; height: 32px">
                            <img src="{{ asset('assets/dist/icon/youtube.png') }}" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-6">
                <div class="d-flex flex-wrap row-gap-5">
                    <div class="col-12 col-md-4 col-lg-4 text-white">
                        <div class="d-flex flex-column gap-3">
                            <div class="poppins-semibold text-white">Tentang Kami</div>
                            <a href="#" class="poppins-regular text-color-icon">Pelayanan</a>
                            <a href="#" class="poppins-regular text-color-icon">Peraturan</a>
                            <a href="#" class="poppins-regular text-color-icon">Metode pembayaran</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4 text-white">
                        <div class="d-flex flex-column gap-3">
                            <div class="poppins-semibold text-white">Hubungi Kami</div>
                            <a href="#" class="poppins-regular text-color-icon">Kontak</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4 text-white">
                        <div class="d-flex flex-column gap-3">
                            <div class="poppins-semibold text-white">Support</div>
                            <a href="#" class="poppins-regular text-color-icon">Pusat bantuan</a>
                            <a href="#" class="poppins-regular text-color-icon">Pusat keamanan</a>
                            <a href="#" class="poppins-regular text-color-icon">Pedoman komunitas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center py-5" style="color: #78828E">©2024 Banteran All Right Reserved</div>
</footer>
