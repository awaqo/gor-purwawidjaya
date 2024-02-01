@extends('layout.app-admin')

@section('title', 'Fasilitas GOR')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('admin.facility') }}" class="btn btn-outline-primary px-3 border border-light-subtle">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <h1 class="m-0">Fasilitas GOR Purwawidjaya</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item">Fasilitas</li>
                        <li class="breadcrumb-item active">Edit Fasilitas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container">
            <form action="{{ url('admin/umum/edit-fasilitas/' . $facility->id) }}" method="POST" enctype="multipart/form-data">
                @if (isset($facility))
                    @method('PUT')
                @endif
                @csrf
                <div class="col">
                    <label for="fac_name" class="form-label">Nama Fasilitas</label>
                    <input type="text" name="fac_name" class="form-control" id="fac_name" value="{{ $facility->fac_name }}" required>
                </div>

                <div class="mt-3">
                    <button id="btn-edit-fasilitas" type="submit" class="btn btn-block btn-success">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
