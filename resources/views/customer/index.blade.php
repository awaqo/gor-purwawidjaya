@extends('layout.app')

@section('title', 'Booking Lapangan Dimana Saja')

@section('content')
    {{-- <div class="m-0 pt-3">
        <div class="row">
            <div class="col-lg-6">
                <div class="col">
                    <div class="fw-medium" style="font-size: 60px; line-height: 80px">
                        Buat Pengalaman Bermain Bulutangkis Lebih <span style="color: #FC4C47;">Seru & Praktis</span>
                    </div>
                    <div class="col-md-9 mt-3 fw-medium" style="font-size: 20px; line-height: 27px; color: #78828E;">
                        Nikmati pengalaman keseruan bermain bersama teman lebih mudah dan praktis
                    </div>
                    <div class="mt-5">
                        <a href="#" class="btn btn-danger px-5 py-3 rounded-5 fw-medium" style="background-color: #FC4C47 !important;">Sewa Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/dist/img/image 22.png') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="row py-5">
            <div class="col-lg-6">
                <div class="col">
                    <div class="fw-bold" style="font-size: 50px; line-height: 80px; color: #0A0E1A;">
                        Bermain Lebih Praktis dan Sistematis
                    </div>
                    <div class="col-md-9 mt-3 fw-medium" style="font-size: 20px; line-height: 34px; color: #78828E;">
                        Kini bermain bulutangkis lebih mudah, sistematis dan termanagement dengan baik
                    </div>
                    <div class="mt-5">
                        <div class="d-flex mb-3 gap-2 align-items-center">
                            <div>
                                <img src="{{ asset('assets/dist/img/Frame-cek.png') }}" class="img-fluid" alt="">
                            </div>
                            <div style="font-weight: 400; color: #78828E;">Buat Akun</div>
                        </div>
                        <div class="d-flex mb-3 gap-2 align-items-center">
                            <div>
                                <img src="{{ asset('assets/dist/img/Frame-cek.png') }}" class="img-fluid" alt="">
                            </div>
                            <div style="font-weight: 400; color: #78828E;">Lihat Jadwal</div>
                        </div>
                        <div class="d-flex mb-3 gap-2 align-items-center">
                            <div>
                                <img src="{{ asset('assets/dist/img/Frame-cek.png') }}" class="img-fluid" alt="">
                            </div>
                            <div style="font-weight: 400; color: #78828E;">Booking Jadwal</div>
                        </div>
                        <div class="d-flex mb-3 gap-2 align-items-center">
                            <div>
                                <img src="{{ asset('assets/dist/img/Frame-cek.png') }}" class="img-fluid" alt="">
                            </div>
                            <div style="font-weight: 400; color: #78828E;">Bayar</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/dist/img/Group 16.png') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div> --}}
    
    {{-- List orang booking --}}
    <div class="mt-3 table-responsive">
        <div class="h2">Sewa Sedang Berlangsung</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center text-light" style="background-color: #0A0E1A;">Lapangan</th>
                    <th scope="col" class="text-center text-light" style="background-color: #0A0E1A;">Tanggal Main</th>
                    <th scope="col" class="text-center text-light" style="background-color: #0A0E1A;">Nama Pembooking</th>
                    <th scope="col" class="text-center text-light" style="background-color: #0A0E1A;">Jam Main</th>
                </tr>
            </thead>
            <tbody>
                @if ($lastBook == null)
                    <tr>
                        <td colspan="4" class="text-center">Belum ada transaksi</td>
                    </tr>
                @else
                    @forelse ($Transaction as $data)
                        @if ($data->payment_status == 'paid' && $data->order_status !== 'cancelled' && $data->order_status !== 'completed')
                            <tr class="text-center">
                                <td id="{{ $data->booking_id }}" class="bk_id">{{ $data->court_name }}</td>
                                <td><span
                                        class="badge bg-success booking_date">{{ date('Y-m-d', strtotime($data->date)) }}</span>
                                </td>
                                <td>{{ $data->booking_name }}</td>
                                <td>
                                    @foreach ($BkTime->where('booking_id', $data->booking_id) as $item)
                                        <span class="badge bg-primary play_time">{{ $item->play_time }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada transaksi</td>
                        </tr>
                    @endforelse
                @endif
            </tbody>
        </table>
    </div>

    {{-- Lapangan --}}
    <div class="daftar-lapangan h2 mt-3">Daftar Lapangan</div>
    <div class="row justify-content-center mb-5">
        <a href="/booking/1/lapangan-1"></a>
        @foreach ($courts as $item)
            <a dusk="{{ $item->court->id }}_{{ $item->court->slug }}"
                href="{{ url('booking/' . $item->court->id . '/' . $item->court->slug) }}"
                class="col-12 col-md-4 link-underline link-underline-opacity-0">
                <div class="card">
                    <img src="{{ asset(Storage::url($item->image)) }}" class="card-img-top" alt="{{ $item->court_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->court->court_name }}</h5>
                        <p class="card-text col-12 text-truncate">{!! $item->court->description !!}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    {{-- {{ $courts }} --}}

    {{-- Fasilitas --}}
    <div class="mt-5">
        <div class="h2">Fasilitas GOR Purwawidjaya</div>
        <ul>
            @forelse ($facility as $data)
                <li>{{ $data->fac_name }}</li>
            @empty
                <div>Belum ada data fasilitas GOR</div>
            @endforelse
        </ul>
    </div>

    {{-- Perlombaan --}}
    <div class="mt-5 table-responsive">
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
                        <td class="bk_id">{{ $data->title }}</td>
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
    </div>

    {{-- Google Maps --}}
    <div class="mt-5 col-lg-12">
        <h2>Lokasi GOR</h2>
        <div class="w-100 ratio ratio-16x9 mt-2">
            <iframe src="{{ $maps->source }}" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

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
                confirmButtonText: 'OK',
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
        const trx = {!! json_encode($Transaction->toArray()) !!};
        const booking = {!! json_encode($BkTime->toArray()) !!};
        const timer = {!! json_encode($Timer->toArray()) !!};
        var bookDate = document.querySelector(".booking_date").textContent;
        var playTime = document.querySelector(".play_time").textContent;
        var bkId = document.querySelector(".bk_id");
        var bookingId = bkId.getAttribute('id');

        let today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        var currentHour = today.getHours();

        // tambah 0 jika hari < 10
        if (dd < 10) {
            dd = '0' + dd;
        }
        // tambah 0 jika bulan < 10
        if (mm < 10) {
            mm = '0' + mm;
        }

        today = yyyy + '-' + mm + '-' + dd;

        $(document).ready(() => {
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
