@extends('layout.app-auth')

@section('title', 'Login')

@section('content')
    <div class="row" style="width: 100%">
        <div class="col-12 col-xl-6 d-none d-lg-block">
            <div class="image-wrapper">
                <img src="{{ asset('assets/dist/img/login/Mask group.png') }}" class="w-100" alt="">
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="form-wrapper">
                <div class="d-flex flex-column form-max-w px-4">
                    <div class="">
                        <div class="poppins-bold fs-1">Selamat Datang di GOR Purwawidjaya</div>
                        <div class="poppins-normal mt-4">Ayo masuk terlebih dahulu sebelum melakukan penyewaan lapangan
                        </div>
                    </div>
                    <div class="mt-5 pe-lg-5">
                        <form action="{{ route('do.login') }}" id="form-input" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingEmail" pattern=".+@.+\..+"
                                    placeholder="Email">
                                <label for="floatingEmail" class="form-label">Email</label>
                            </div>

                            <div class="form-floating mb-3" style="position: relative;">
                                <input type="password" name="password" class="form-control" id="floatingPassword"
                                    placeholder="Kata sandi">
                                <label class="form-label" for="floatingPassword">Kata sandi</label>
                                <div class="toggle-psw">
                                    <i class="fa-regular fa-eye" id="iconToggle" onclick="togglePassword()"></i>
                                </div>
                            </div>

                            <button type="submit" id="login-btn"
                                class="login-btn poppins-semibold col-12 mt-4">Masuk</button>
                            <div class="text-center mt-4">
                                <span class="text-secondary poppins-semibold">Belum punya akun?</span> <a
                                    href="{{ route('register') }}" class="poppins-semibold text-link">Buat akun dulu</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="d-flex justify-content-center mt-3 border">
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

                <button type="submit" id="login-btn" class="btn btn-primary col-12">Masuk</button>
                <div class="text-center mt-3">
                    <span class="text-secondary">Belum punya akun?</span> <a href="{{ route('register') }}">Daftar</a>
                </div>
            </form>
        </div>
    </div> --}}
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let form = document.querySelector("#form-input");
        let emailInput = document.querySelector("#floatingEmail");
        let pswInput = document.querySelector("#floatingPassword");
        let btnLogin = document.querySelector("#login-btn");

        btnLogin.disabled = true;
        form.addEventListener("keyup", stateHandle);

        function stateHandle() {
            if (emailInput.value !== "" && pswInput.value.length > 7) {
                btnLogin.disabled = false;
                btnLogin.classList.add("button-on");
            } else {
                btnLogin.disabled = true;
                btnLogin.classList.remove("button-on");
            }
        }
    
        function togglePassword() {
            var toggle = document.getElementById("floatingPassword");
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
