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
        {{ $courts }}
        @foreach ($courts as $court)
            <div>{{ $court->name }}</div>
            <img src="{{ asset(Storage::url($court->image)) }}" alt="">
        @endforeach

        {{-- Jadwal yang tersedia --}}
        @php
            $disabled = '';
        @endphp
        @if ($weekday == 'Min' || $weekday == 'Sab')
            <div class="h2">Jadwal Tersedia : Weekend</div>
            @foreach ($schedules as $schedule)
                @if ($schedule->timeStart < $today && $schedule->timeEnd <= $today)
                    @php
                        $disabled = 'disabled';
                    @endphp
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="schedule-{{ $schedule->id }}"
                            value="option-{{ $schedule->id }}" {{ $disabled }}>
                        <label class="form-check-label" for="schedule-{{ $schedule->id }}">
                            <div class="d-flex">
                                <div>{{ $schedule->timeStart }}.00</div>
                                <div>&nbsp;-&nbsp;</div>
                                <div>{{ $schedule->timeEnd }}.00</div>
                            </div>
                        </label>
                    </div>
                @else
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="schedule-{{ $schedule->id }}"
                            value="option-{{ $schedule->id }}">
                        <label class="form-check-label" for="schedule-{{ $schedule->id }}">
                            <div class="d-flex">
                                <div>{{ $schedule->timeStart }}.00</div>
                                <div>&nbsp;-&nbsp;</div>
                                <div>{{ $schedule->timeEnd }}.00</div>
                            </div>
                        </label>
                    </div>
                @endif
            @endforeach
        @else
            <div class="h2">Jadwal Tersedia : Weekday</div>
            @foreach ($schedules as $schedule)
                @if ($schedule->timeStart < $today && $schedule->timeEnd <= $today)
                    @php
                        $disabled = 'disabled';
                    @endphp
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="schedule-{{ $schedule->id }}"
                            value="option-{{ $schedule->id }}" {{ $disabled }}>
                        <label class="form-check-label" for="schedule-{{ $schedule->id }}">
                            <div class="d-flex">
                                <div>{{ $schedule->timeStart }}.00</div>
                                <div>&nbsp;-&nbsp;</div>
                                <div>{{ $schedule->timeEnd }}.00</div>
                            </div>
                        </label>
                    </div>
                @else
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="schedule-{{ $schedule->id }}"
                            value="option-{{ $schedule->id }}">
                        <label class="form-check-label" for="schedule-{{ $schedule->id }}">
                            <div class="d-flex">
                                <div>{{ $schedule->timeStart }}.00</div>
                                <div>&nbsp;-&nbsp;</div>
                                <div>{{ $schedule->timeEnd }}.00</div>
                            </div>
                        </label>
                    </div>
                @endif
            @endforeach
        @endif
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
