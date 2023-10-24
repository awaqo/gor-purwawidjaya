@extends('layout.app-auth')

@section('title', 'Login')

@section('content')
    <div class="d-flex justify-content-center mt-3">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: "{{ $error }}",
                        confirmButtonText: 'OK',
                        timerProgressBar: true,
                    })
                </script>
            @endforeach
        @endif
        <div class="col-md-5 col-12 border shadow rounded mt-5 p-4">
            <form action="{{ route('do.login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password">
                        <div class="input-group-text">
                            <i class="fa-solid fa-eye" id="iconToggle" onclick="togglePassword()"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary col-12">Submit</button>
                <div class="text-center mt-3">
                    <span class="text-secondary">Belum punya akun?</span> <a href="{{ route('register') }}">Daftar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function togglePassword() {
            var toggle = document.getElementById("password");
            var icon = document.getElementById("iconToggle");
            if (toggle.type === "password") {
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
                toggle.type = "text";
            } else {
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
                toggle.type = "password";
            }
        }
    </script>
@endpush
