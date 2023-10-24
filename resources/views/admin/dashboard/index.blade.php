@extends('layout.app-admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mt-5">
        <h1>Admin Dashboard</h1>
        <div>Halo, {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}</div>
        <div>Halo, {{ ucwords(Auth::user()->name) }}</div>
        <div>{{ Auth::user()->role }}</div>
        <a href="{{ route('logout') }}">Logout</a>
        <a href="{{ route('home') }}">customer</a>

        @if (Session::has('message'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Login Berhasil',
                    text: "{{ Session::get('message') }}",
                    showConfirmButton: false,
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                })
            </script>
        @elseif (Session::has('islogin'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    text: "{{ Session::get('islogin') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                })
            </script>
        @elseif (Session::has('CustArea'))
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: "Customer Area",
                    text: "{{ Session::get('CustArea') }}",
                    timer: 3000,
                    timerProgressBar: true,
                })
            </script>
        @endif
    </div>
@endsection
