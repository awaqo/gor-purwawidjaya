@extends('layout.app-admin')

@section('title', isset($item) ? 'Edit Foto Lapangan' : 'Tambah Foto Lapangan')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.court.detail', $court->id) }}"
                        class="btn btn-outline-primary px-3 border border-light-subtle">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item">Lapangan</li>
                        <li class="breadcrumb-item">{{ $court->court_name }}</li>
                        <li class="breadcrumb-item active">Edit Foto</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="container">
                <form action="{{ isset($item) ? url('/admin/edit-foto-lapangan/' . $item->id) : url('admin/add-foto-lapangan')}}" method="POST" enctype="multipart/form-data">
                    @if (isset($item))
                        @method('PUT')
                    @endif
                    @csrf
    
                    <div class="row">
                        @if (isset($item))
                            <div class="col">
                                <div class="fw-semibold">Foto Sekarang</div>
                                <img width="400" style="max-height: 300px" src="{{ asset(Storage::url($item->image)) }}" class="img-fluid rounded-4" alt="">
                            </div>
                            <div class="col">
                                <div class="fw-semibold">Preview Foto Terbaru</div>
                                <img id="imgPreviewCourt" class="img-fluid rounded-4 mb-1">
                                <input type="file" class="form-control" name="image" id="image" onchange="previewImage()" required>
                            </div>
                        @else
                            <div class="col">
                                <div class="fw-semibold">Preview Foto</div>
                                <img id="imgPreviewCourt" class="img-fluid rounded-4 mb-1">
                                <input type="file" class="form-control" name="image" id="image" onchange="previewImage()" required>
                                <input type="hidden" name="court_id" value="{{ $court->id }}">
                            </div>
                        @endif
                    </div>
                    <div class="mt-3">
                        <button id="btn-edit-tambah" type="submit" class="btn btn-block {{ isset($item) ? 'btn-outline-success' : 'btn-success'}}">
                            {{ isset($item) ? 'Edit' : 'Tambah' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @if (Session::has('successEditPhoto'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Edit Berhasil',
                text: "{{ Session::get('successEditPhoto') }}",
                showConfirmButton: false,
                toast: true,
                timer: 4000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('successAddPhoto'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Tambah Berhasil',
                text: "{{ Session::get('successAddPhoto') }}",
                showConfirmButton: false,
                toast: true,
                timer: 4000,
                timerProgressBar: true,
            })
        </script>
    @endif
@endsection

@push('scripts')
    <script>
        function previewImage() {
            var preview = document.getElementById('imgPreviewCourt');
            var file = document.querySelector('input[type=file]').files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                var tempImg = new Image();
                tempImg.src = reader.result;

                tempImg.onload = function() {
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');

                    canvas.width = 400;
                    canvas.height = 300;

                    ctx.drawImage(tempImg, 0, 0, 400, 300);

                    preview.src = canvas.toDataURL('image/jpeg', 1.0);
                }
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush