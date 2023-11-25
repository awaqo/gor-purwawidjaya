@extends('layout.app')

@section('title', 'Booking Lapangan Dimana Saja')

@section('content')
    <div class="my-5">
        <h1>Halaman Customer</h1>

        @guest
            <div>Anda belum login</div>
            <a class="d-flex" href="{{ route('login') }}">Login</a>
            <a class="d-flex" href="{{ route('register') }}">Register</a>
            <a class="d-flex" href="{{ route('logout') }}">Logout</a>
        @endguest

        @auth
            <div>Anda sudah login</div>
            <div>Halo, {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}</div>
            <div>Halo, {{ ucwords(Auth::user()->name) }}</div>
            <div>{{ Auth::user()->role }}</div>
            <div>{{ auth()->user()->name }}</div>
            <div>{{ auth()->user()->role }}</div>

            <a class="d-flex" href="{{ route('logout') }}">Logout</a>
            <a class="d-flex" href="{{ route('login') }}">cek middleware login</a>
            <a class="d-flex" href="{{ route('register') }}">cek middleware register</a>

        @endauth
        <a class="d-flex" href="{{ route('dashboard') }}">admin</a>

        <hr class="border border-primary border-3 opacity-75">

        {{-- Lapangan --}}
        <div class="h2">Daftar Lapangan</div>
        <div class="row justify-content-center border">
            @foreach ($courts as $item)
                <a href="{{ url('booking/'.$item->court->slug) }}" class="col-12 col-md-4 link-underline link-underline-opacity-0">
                    <div class="card">
                        <img src="{{ asset(Storage::url($item->image)) }}" class="card-img-top" alt="{{ $item->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->court->name }}</h5>
                            <p class="card-text">{{ $item->court->description }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
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
    @endif

@endsection
