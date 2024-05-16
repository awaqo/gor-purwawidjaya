@extends('layout.app')

@section('title', 'Profil')

@section('content')
    <div class="container container-profil min-vh-100">
        <div class="d-flex flex-md-row flex-sm-column flex-wrap">
            @include('include.profile.sidebar-profil')
            
            <div class="col-12 col-md-8 col-lg-8 border rounded-4 p-4 p-lg-5">
                <form action="" method="post">
                    <div class="d-flex flex-column gap-4">
                        <div>
                            <label for="nama" class="poppins-semibold mb-2">Nama Pengguna</label>
                            <input class="form-control px-3 rounded-4" type="text" name="name" id="nama" value="{{ $user->name }}" style="padding-top: 12px; padding-bottom: 12px">
                        </div>
                        <div>
                            <label for="email" class="poppins-semibold mb-2">Email</label>
                            <input class="form-control px-3 rounded-4" type="email" name="email" id="email" value="{{ $user->email }}" pattern=".+@.+\..+" style="padding-top: 12px; padding-bottom: 12px">
                        </div>
                        <div>
                            <label for="no_hp" class="poppins-semibold mb-2">No HP</label>
                            <input class="form-control px-3 rounded-4" type="number" name="phone_number" id="no_hp" value="{{ $user->phone_number }}" style="padding-top: 12px; padding-bottom: 12px">
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn-simpan-profil poppins-semibold px-5 py-3 rounded-5 border-0">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection