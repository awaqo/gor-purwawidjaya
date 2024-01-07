@extends('layout.app')

@section('title', 'Booking Lapangan Dimana Saja')

@section('content')
    <h1>Halaman Customer</h1>

    @if (Auth::check())
        <div id="uid" class="d-none">{{ Auth::user()->id }}</div>
    @else
        <div id="uid" class="d-none">null</div>
    @endif
    <a class="d-flex" href="{{ route('admin.dashboard') }}">admin</a>

    <hr class="border border-primary border-3 opacity-75">

    {{-- List orang booking --}}
    <div class="mt-3 table-responsive">
        <div class="h2">List Booking</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="bg-secondary text-light text-center">Lapangan</th>
                    <th scope="col" class="bg-secondary text-light text-center">Tanggal Main</th>
                    <th scope="col" class="bg-secondary text-light text-center">Nama Pembooking</th>
                    <th scope="col" class="bg-secondary text-light text-center">Jam Main</th>
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
                                <td><span class="badge bg-success booking_date">{{ date('Y-m-d', strtotime($data->date)) }}</span></td>
                                <td>{{ $data->booking_name }}</td>
                                <td>
                                    @foreach ($BkTime->where('booking_id', $data->booking_id) as $item)
                                        <span class="badge bg-primary">{{ $item->play_time }}</span>
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
    <div class="h2 mt-3">Daftar Lapangan</div>
    <div class="row justify-content-center">
        @foreach ($courts as $item)
            <a href="{{ url('booking/' . $item->court->id . '/' . $item->court->slug) }}"
                class="col-12 col-md-4 link-underline link-underline-opacity-0">
                <div class="card">
                    <img src="{{ asset(Storage::url($item->image)) }}" class="card-img-top" alt="{{ $item->court_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->court->court_name }}</h5>
                        <p class="card-text">{{ $item->court->description }}</p>
                    </div>
                </div>
            </a>
        @endforeach
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
            updateBookingList();
        });

        function updateBookingList() {
            for (a = 0; a < trx.length; a++) {
                var bookId = trx[a].booking_id;
                if (trx[a].payment_status == 'paid' && trx[a].order_status !== 'completed' && trx[a].order_status !== 'cancelled') {
                    var bid = trx[a].booking_id;
                    console.log(bid);
                    for (b = 0; b < booking.length; b++) {
                        var bD = booking[b].date;
                        if (today == bD && booking[b].booking_id == bid) {
                            console.log(bD);
                            console.log(booking[b].schedule_id);
                            var scheduleId = booking[b].schedule_id;
                        }
                    }
                }
            }

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
                    success: (res) => {
                    },
                });
            } else {
                console.log('booking belum selesai');
            }
        }
    </script>
@endpush
