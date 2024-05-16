@extends('layout.app')

@section('title', 'Booking Lapangan Dimana Saja')

@section('content')
    <div class="scrollspy-example" data-bs-spy="scroll" data-bs-target="navbar-sites" data-bs-smooth-scroll="true"
        tabindex="0">
        <section id="beranda" class="background-hero-body">
            <div class="container hero-body">
                <div class="col-lg-6 p-0 d-flex align-items-center">
                    <div class="col">
                        <div class="poppins-semibold text-color-primary title-body">
                            Buat Pengalaman Bermain Bulutangkis Lebih <span class="title-highlight">Seru & Praktis</span>
                        </div>
                        <div class="col-md-10 mt-3 poppins-medium text-color-secondary sub-title-body">
                            Nikmati pengalaman keseruan bermain bersama teman lebih mudah dan praktis
                        </div>
                        <div class="mt-5">
                            <a href="#lapangan"
                                class="btn-sewa-home px-5 py-3 rounded-5 poppins-semibold text-color-primary">Sewa
                                Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-5">
                    <img src="{{ asset('assets/dist/img/image 22.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </section>

        <section id="jadwal" class="container-fluid px-3 py-5">
            <div class="d-flex flex-column align-items-center px-2 mt-5">
                <div class="title-text text-color-primary text-center poppins-bold">Langkah Mudah dan Praktis</div>
                <div class="sub-title-text poppins-medium text-color-secondary text-center mt-3">
                    Hanya dengan 4 langkah kamu bisa memulai untuk menyewa lapangan
                </div>
            </div>

            {{-- langkah --}}
            <div class="d-flex justify-content-center flex-wrap row-gap-5 mt-5 px-3 px-lg-5 pb-4">
                <div class="col-12 col-md-5 col-lg-3">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-circle d-flex justify-content-center align-items-center"
                                style="background-color: #B7EB38">
                                <div class="icon-step" style="width: 24px; height: 24px">
                                    <img src="{{ asset('assets/dist/icon/akun.png') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="text-color-primary poppins-semibold fs-5">Buat Akun</div>
                        </div>

                        <div class="text-color-secondary pe-5">Buat akun terlebih dahulu untuk bisa menyewa lapangan</div>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-lg-3">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-circle d-flex justify-content-center align-items-center"
                                style="background-color: #B7EB38">
                                <div class="icon-step" style="width: 24px; height: 24px">
                                    <img src="{{ asset('assets/dist/icon/jadwal.png') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="text-color-primary poppins-semibold fs-5">Lihat Jadwal</div>
                        </div>

                        <div class="text-color-secondary pe-5">Setelah buat akun, lihat jadwal lapangan yang masih tersedia
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-lg-3">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-circle d-flex justify-content-center align-items-center"
                                style="background-color: #B7EB38">
                                <div class="icon-step" style="width: 24px; height: 24px">
                                    <img src="{{ asset('assets/dist/icon/booking.png') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="text-color-primary poppins-semibold fs-5">Booking Lapangan</div>
                        </div>

                        <div class="text-color-secondary pe-5">Pilih lapangan dan jam yang masih tersedia lalu booking
                            lapangan
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-lg-3">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-circle d-flex justify-content-center align-items-center"
                                style="background-color: #B7EB38">
                                <div class="icon-step" style="width: 24px; height: 24px">
                                    <img src="{{ asset('assets/dist/icon/bayar.png') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="text-color-primary poppins-semibold fs-5">Bayar</div>
                        </div>

                        <div class="text-color-secondary pe-5">Setelah pembayaran, konfirmasi ke admin penjaga lapangan
                        </div>
                    </div>
                </div>
            </div>

            {{-- tabel jadwal tersedia --}}
            <div class="d-flex flex-column align-items-center mt-5">
                <div class="title-text text-color-primary poppins-bold">Lapangan Banteran</div>
                <div class="sub-title-text poppins-medium text-color-secondary mt-3">Ayo sewa lapangan dan lihat terlebih
                    dahulu jadwal yang kosong</div>
            </div>

            {{-- List booking --}}
            <div class="mt-5 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center align-middle border-0 py-4 text-light list-booking">
                                Lapangan</th>
                            <th scope="col" class="text-center align-middle border-0 py-4 text-light list-booking">
                                Tanggal</th>
                            <th scope="col" class="text-center align-middle border-0 py-4 text-light list-booking">
                                Nama Pembooking
                            </th>
                            <th scope="col" class="text-center align-middle border-0 py-4 text-light list-booking">
                                Jam Main</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="noTrx">
                            <td colspan="4" class="text-center py-4">Belum ada transaksi</td>
                        </tr>
                        @foreach ($Transaction as $data)
                            @if ($data->payment_status == 'paid' && $data->order_status !== 'cancelled' && $data->order_status !== 'completed')
                                <tr class="text-center" id="table-schedule">
                                    <td id="{{ $data->booking_id }}" class="bk_id py-3">{{ $data->court_name }}</td>
                                    <td class="py-3"><span
                                            class="badge bg-success booking_date">{{ date('Y-m-d', strtotime($data->date)) }}</span>
                                    </td>
                                    <td class="py-3">{{ $data->booking_name }}</td>
                                    <td class="py-3">
                                        @foreach ($BkTime->where('booking_id', $data->booking_id) as $item)
                                            <span class="badge bg-primary play_time">{{ $item->play_time }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Lapangan --}}
        <section id="lapangan" class="container-fluid py-5 background-choose-court">
            <div class="container">
                <div class="d-flex flex-column align-items-center mt-4">
                    <div class="title-text text-color-primary poppins-bold text-center">Kelola Lapangan dalam Hitungan
                        Detik</div>
                    <div class="sub-title-text text-color-secondary my-3">Sewa lapangan impian Anda dengan mudah dan cepat
                        di
                        sini</div>
                </div>

                <div class="row justify-content-center row-gap-4 my-4">
                    @foreach ($courts as $item)
                        <a dusk="{{ $item->court->id }}_{{ $item->court->slug }}"
                            href="{{ url('booking/' . $item->court->id . '/' . $item->court->slug) }}"
                            class="col-12 col-md-6 col-lg-4 link-underline link-underline-opacity-0">
                            <div class="card" style="border-radius: 10px !important">
                                <img src="{{ asset(Storage::url($item->image)) }}" class="card-img-top"
                                    alt="{{ $item->court_name }}">
                                <div class="card-body">
                                    <h4 class="card-title text-color-primary poppins-semibold">
                                        {{ $item->court->court_name }}
                                    </h4>
                                    <p class="card-text col-12 text-truncate">{!! $item->court->description !!}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="akademi">
            <div class="container my-3">
                <div class="d-flex flex-lg-row flex-md-column row-gap-4 flex-wrap align-items-end academy-wrapper">
                    <div class="col-12 col-md-12 col-lg-5">
                        <img src="{{ asset('assets/dist/img/akademi/bocil-akademi.png') }}" class="img-fluid w-md-100"
                            alt="">
                    </div>

                    <div class="col-12 col-md-12 col-lg-7 ps-lg-3">
                        <div class="d-flex flex-column row-gap-3">
                            <div class="poppins-bold text-color-primary title-text">Ingin hebat bermain?</div>
                            <div class="poppins-medium text-color-secondary desc-academy">
                                Ingin hebat dalam bermain bulutangkis sejak dini? kini kamu bisa bergabung di akademi
                                badminton
                                untuk belajar badminton dengan pelatih expert
                            </div>

                            <div class="d-flex flex-wrap gap-5">
                                <div>
                                    <div class="poppins-medium text-color-primary mb-2" style="font-size: 36px">200+</div>
                                    <div class="poppins-regular text-color-secondary fs-6">Peserta aktif</div>
                                </div>
                                <div>
                                    <div class="poppins-medium text-color-primary mb-2" style="font-size: 36px">3</div>
                                    <div class="poppins-regular text-color-secondary fs-6">Pelatih expert</div>
                                </div>
                            </div>

                            <a href="{{ route('info-akademi') }}"
                                class="btn-join-academy px-3 py-3 mt-lg-4 rounded-5 poppins-semibold">Gabung
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="fasilitas" style="margin-bottom: 60px">
            <div class="container my-3">
                <div class="d-flex flex-lg-row flex-md-column row-gap-4 flex-wrap facility-wrapper">
                    <div class="col-12 col-md-12 col-lg-6">
                        <img src="{{ asset('assets/dist/img/fasilitas/foto-fasilitas.png') }}" class="img-fluid w-md-100"
                            alt="">
                    </div>

                    <div class="col-12 col-md-12 col-lg-6 ps-lg-3">
                        <div class="d-flex flex-column row-gap-3">
                            <div class="poppins-bold text-color-primary title-text">Fasilitas Terbaik untuk Anda</div>
                            <div class="poppins-medium text-color-secondary desc-facility">
                                Berikut beberapa fasilitas yang kami sediakan untuk anda
                            </div>

                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="icon-step" style="width: 36px; height: 36px">
                                            <img src="{{ asset('assets/dist/img/fasilitas/check-list.png') }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="text-color-secondary poppins-medium">3 Lapangan bulutangkis</div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="icon-step" style="width: 36px; height: 36px">
                                            <img src="{{ asset('assets/dist/img/fasilitas/check-list.png') }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="text-color-secondary poppins-medium">Menyediakan Shuttlecock dan grip</div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="icon-step" style="width: 36px; height: 36px">
                                            <img src="{{ asset('assets/dist/img/fasilitas/check-list.png') }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="text-color-secondary poppins-medium">Warung makan & minum</div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="icon-step" style="width: 36px; height: 36px">
                                            <img src="{{ asset('assets/dist/img/fasilitas/check-list.png') }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="text-color-secondary poppins-medium">Mushola</div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="icon-step" style="width: 36px; height: 36px">
                                            <img src="{{ asset('assets/dist/img/fasilitas/check-list.png') }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="text-color-secondary poppins-medium">Parkiran luas</div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="icon-step" style="width: 36px; height: 36px">
                                            <img src="{{ asset('assets/dist/img/fasilitas/check-list.png') }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="text-color-secondary poppins-medium">Kamar mandi</div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="icon-step" style="width: 36px; height: 36px">
                                            <img src="{{ asset('assets/dist/img/fasilitas/check-list.png') }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="text-color-secondary poppins-medium">Ruang ganti</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimoni" class="background-testimoni py-5">
            <div class="container py-5">
                <div class="d-flex justify-content-center px-2">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="title-text text-color-primary poppins-bold text-center">Apa kata mereka tentang kami?
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap row-gap-4 mt-5">
                    <div class="col-12 col-md-6 col-lg-6 px-2">
                        <div class="bg-white p-5 rounded-4">
                            <div class="col">
                                <div class="d-flex column-gap-4">
                                    <div style="width: 72px; height: 72px">
                                        <img src="{{ asset('assets/dist/img/testimoni/testi-1.jpg') }}"
                                            class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <div class="d-flex flex-column row-gap-2">
                                        <div class="col poppins-semibold text-color-primary" style="font-size: 24px">Janet
                                        </div>
                                        <div class="col text-color-secondary">Pelajar</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col text-color-secondary mt-4 testimoni-text">
                                “Lapanganya banyak, tempat nya bersih dan enak. selain itu pelayananya juga enak & teratur
                                sesuai sama jadwal”
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 px-2">
                        <div class="bg-white p-5 rounded-4">
                            <div class="col">
                                <div class="d-flex column-gap-4">
                                    <div style="width: 72px; height: 72px">
                                        <img src="{{ asset('assets/dist/img/testimoni/testi-2.jpg') }}"
                                            class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <div class="d-flex flex-column row-gap-2">
                                        <div class="col poppins-semibold text-color-primary" style="font-size: 24px">Ucup
                                        </div>
                                        <div class="col text-color-secondary">Pelajar</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col text-color-secondary mt-4 testimoni-text">
                                “Enak banget main di lapangan banteran, dari segi pelayanan oke, sesuai sama jadwal yang
                                tersedia”
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Perlombaan --}}
    {{-- <div class="mt-5 mx-2 table-responsive">
        <div class="h2">Informasi Perlombaan</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center text-light" style="background-color: #0A0E1A;">Nama</th>
                    <th scope="col" class="text-center text-light" style="background-color: #0A0E1A;">Lokasi</th>
                    <th scope="col" class="text-center text-light" style="background-color: #0A0E1A;">Pelaksanaan</th>
                    <th scope="col" class="text-center text-light" style="background-color: #0A0E1A;">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($compe as $data)
                    <tr class="text-center">
                        <td>{{ $data->title }}</td>
                        <td>{{ $data->location }}</td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <div class="bg-primary px-2 py-1 badge">
                                    {{ date('D, d-m-Y', strtotime($data->date_start)) }}</div>
                                <div>-</div>
                                <div class="bg-primary px-2 py-1 badge">{{ date('D, d-m-Y', strtotime($data->date_end)) }}
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ $data->description }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada informasi lomba</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> --}}

    {{-- pop up --}}

    @if (Session::has('message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil',
                text: "{{ Session::get('message') }}",
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('regSuccess'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Registrasi Akun',
                text: "{{ Session::get('regSuccess') }}",
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('successBooking'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Booking Berhasil',
                text: "{{ Session::get('successBooking') }}",
                customClass: {
                    confirmButton: "btn-booking focus-none py-3 poppins-semibold rounded-5"
                },
                confirmButtonText: '<a class="text-decoration-none btn-booking w-100 h-100 rounded-5 px-5 py-3" href="{{ url('/riwayat-pesanan') }}">Bayar sekarang</a>',
            })
        </script>
    @elseif (Session::has('AdminArea'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Admin Only',
                text: "{{ Session::get('AdminArea') }}",
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('islogin'))
        <script>
            Swal.fire({
                icon: 'info',
                text: "{{ Session::get('islogin') }}",
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('checkLogin'))
        <script>
            Swal.fire({
                icon: 'warning',
                text: "{{ Session::get('checkLogin') }}",
            })
        </script>
    @endif

@endsection

@push('scripts')
    <script>
        let today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        var currentHour = today.getHours();

        const trx = {!! json_encode($Transaction->toArray()) !!};
        const booking = {!! json_encode($BkTime->toArray()) !!};
        const timer = {!! json_encode($Timer->toArray()) !!};
        var bookDate = document.querySelector(".booking_date").textContent;
        var playTime = document.querySelector(".play_time").textContent;
        var bkId = document.querySelector(".bk_id");
        var bookingId = bkId.getAttribute('id');
    </script>
    <script>
        // tambah 0 jika hari < 10
        if (dd < 10) {
            dd = '0' + dd;
        }
        // tambah 0 jika bulan < 10
        if (mm < 10) {
            mm = '0' + mm;
        }

        today = yyyy + '-' + mm + '-' + dd;

        $(document).ready(function() {
            if ($(".table-bordered > tbody > tr").length == null || $(".table-bordered > tbody > tr").length == 0 || $(".table-bordered > tbody > tr:not(:contains(lapangan))")) {
                $(".noTrx").show();
                console.log('kosong');
            } else {
                $(".noTrx").hide();
                console.log('isi');
            }
            // if ($(".table-bordered > tbody > tr:contains(transaksi)") && $(".table-bordered > tbody > tr:contains(lapangan)")) {
            //     $(".noTrx").hide();
            // } else {
            //     $(".noTrx").show();
            // }

            console.log(today);

            if (bookDate !== '') {
                console.log('ada sewa berlangsung');
                console.log(bookDate);
                for (a = 0; a < trx.length; a++) {
                    var bookId = trx[a].booking_id;
                    if (trx[a].payment_status == 'paid' && trx[a].order_status !== 'completed' && trx[a]
                        .order_status !== 'cancelled') {
                        var bid = trx[a].booking_id;
                        console.log(bid);
                        for (b = 0; b < booking.length; b++) {
                            var bD = booking[b].date;
                            // console.log(bD);
                            if (today == bD && booking[b].booking_id == bid) {
                                // console.log(booking[b].date);
                                var scheduleId = booking[b].schedule_id;
                            } else if (bD < today && booking[b].booking_id == bid) {
                                var scheduleId = booking[b].schedule_id;
                            }
                        }
                    }
                }
            } else {
                console.log('tidak ada sewa berlangsung');
            }

            console.log(scheduleId);


            for (c = 0; c < timer.length; c++) {
                if (timer[c].id == scheduleId) {
                    var timeEnd = timer[c].timeEnd;
                }
            }

            if (currentHour >= timeEnd) {
                console.log('waktu booking selesai');
                $.ajax({
                    type: "POST",
                    url: "{{ route('update-status') }}",
                    data: {
                        bookingid: bookId,
                    },
                    success: (res) => {},
                });
            } else if (bD < today) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('update-status') }}",
                    data: {
                        bookingid: bookId,
                    },
                    success: (res) => {},
                });
            } else {
                console.log('booking belum selesai');
            }
        });
    </script>
@endpush
