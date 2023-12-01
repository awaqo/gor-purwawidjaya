@extends('layout.app')

@section('title', 'Booking Lapangan Dimana Saja')

@section('content')
    <h1>Halaman Customer</h1>

    @guest
        <div>Anda belum login</div>
    @endguest

    @auth
        <div>Anda sudah login</div>
    @endauth
    <a class="d-flex" href="{{ route('dashboard') }}">admin</a>

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
                    <th scope="col" class="bg-secondary text-light text-center">Tanggal</th>
                    <th scope="col" class="bg-secondary text-light text-center">Nama Pembooking</th>
                    <th scope="col" class="bg-secondary text-light text-center">Jam Main</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listBooking as $data)
                    <tr class="text-center">
                        <td>{{ $data->court_name }}</td>
                        <td><span class="badge bg-success">{{ date('d-m-Y', strtotime($data->date)) }}</span></td>
                        <td>{{ $data->booking_name }}</td>
                        <td><span class="badge bg-primary">{{ $data->timeStart }}.00 - {{ $data->timeEnd }}.00</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada transaksi</td>
                    </tr>
                @endforelse
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
    @endif

@endsection
