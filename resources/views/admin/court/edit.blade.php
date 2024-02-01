@extends('layout.app-admin')

@section('title', 'Edit Lapangan')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.court.manage') }}"
                        class="btn btn-outline-primary px-3 border border-light-subtle">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item">Lapangan</li>
                        <li class="breadcrumb-item">{{ $court->court_name }}</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="container">
                <form action="{{ url('/admin/edit-lapangan/' . $court->id) }}" method="POST" enctype="multipart/form-data">
                    @if (isset($court))
                        @method('PUT')
                    @endif
                    @csrf
    
                    <div class="col">
                        <label for="court_name" class="form-label">Nama Lapangan</label>
                        <input type="text" name="court_name" class="form-control" id="court_name" value="{{ $court->court_name }}" required>
                    </div>

                    <div class="col mt-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" required>{{ $court->description }}</textarea>
                    </div>
                    
                    <div class="mt-3">
                        <button id="btn-edit-lapangan" type="submit" class="btn btn-block btn-outline-success">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush