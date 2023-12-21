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

    {{-- Lapangan --}}
    <div class="h2">Daftar Lapangan</div>
    <div class="row justify-content-center border">
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

    {{-- List orang booking --}}
    <div class="mt-5 table-responsive">
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
                        {{--
                            - sementara menampilkan transaksi yang belum dibayar
                            - TODO: ubah kondisi payment_status menjadi paid
                        --}}
                        @if ($data->payment_status == 'unpaid' && $data->order_status !== 'cancelled' && $data->order_status !== 'completed')
                            <tr class="text-center">
                                <td>{{ $data->court_name }}</td>
                                <td><span class="badge bg-success">{{ date('d-m-Y', strtotime($data->date)) }}</span></td>
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
        const booking = {!! json_encode($Transaction->toArray()) !!};
        
        $(document).ready(() => {
            cancelBooking();
        });

        function cancelBooking() {
            let firstElements = [];
            let noDuplicates = [];
            booking.forEach(object => {
                if (!firstElements.includes(object.booking_name) && object.payment_status != 'paid') {
                    firstElements.push(object.booking_name);
                    noDuplicates.push(object);
                }
            });
            console.log(firstElements);
            console.log(noDuplicates);
        };
    </script>
@endpush
