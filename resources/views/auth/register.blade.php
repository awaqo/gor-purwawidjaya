@extends('layout.app-auth')

@section('title', 'Register')

@section('content')
    <div class="d-flex justify-content-center mt-3">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Registrasi Gagal',
                        text: "{{ $error }}",
                        confirmButtonText: 'OK',
                        timerProgressBar: true,
                    })
                </script>
            @endforeach
        @endif
        <div class="col-md-5 col-12 border shadow rounded mt-5 p-4">
            <form action="{{ route('do.register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" id="name" required autocomplete="true">
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Nomor HP</label>
                    <input type="numeric" name="phone_number" class="form-control" id="phone_number" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required autocomplete="true">
                </div>

                <div class="mb-3">
                    <label for="pass1" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="pass1" minlength="8"
                            spellcheck="false" autocomplete="false" onkeyup="checkPass(); return false;" required>
                        <div class="input-group-text">
                            <i class="fa-solid fa-eye" id="iconToggle" onclick="togglePassword()"></i>
                        </div>
                        <div id="errPass"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="pass2" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control" id="pass2"
                            spellcheck="false" autocomplete="false" onkeyup="checkPassConfirm(); return false;" required>
                        <div class="input-group-text">
                            <i class="fa-solid fa-eye" id="iconToggleConfirm" onclick="toggleConfirmPassword()"></i>
                        </div>
                        <div id="errConfirm"></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary col-12">Daftar</button>
                <div class="text-center mt-3">
                    <span class="text-secondary">Sudah punya akun?</span> <a href="{{ route('login') }}">Masuk</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        var pass1 = document.getElementById('pass1');
        var pass2 = document.getElementById('pass2');
        var message1 = document.getElementById('errPass');
        var message2 = document.getElementById('errConfirm');

        function checkPass() {
            if (pass1.value.length > 7) {
                pass1.classList.remove("is-invalid");
                pass1.classList.add("is-valid");
                message1.style.display = "none";
            } else {
                pass1.classList.remove("is-valid");
                pass1.classList.add("is-invalid");
                message1.classList.add("invalid-feedback");
                message1.style.display = "inline";
                message1.innerHTML = "Password minimal 8 karakter";
                return;
            }
        }

        function checkPassConfirm() {
            if (pass1.value.length > 7 && pass1.value == pass2.value) {
                pass2.classList.remove("is-invalid")
                pass2.classList.add("is-valid")
                message2.classList.remove("invalid-feedback")
                message2.classList.add("valid-feedback")
                message2.innerHTML = "Valid!"
            } else if (pass1.value.length < 8) {
                pass2.classList.add("is-invalid")
                message2.classList.add("invalid-feedback")
                message2.innerHTML = "Password minimal 8 karakter"
            } else {
                pass2.classList.add("is-invalid")
                message2.classList.add("invalid-feedback")
                message2.innerHTML = "Konfirmasi password tidak sesuai"
            }
        }

        function togglePassword() {
            var toggle = document.getElementById("pass1");
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

        function toggleConfirmPassword() {
            var toggle = document.getElementById("pass2");
            var icon = document.getElementById("iconToggleConfirm");
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
