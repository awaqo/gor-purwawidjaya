@extends('layout.app-admin')

@section('title', 'Maps GOR')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('admin.maps') }}" class="btn btn-outline-primary px-3 border border-light-subtle">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <h1 class="m-0">Google Maps GOR Purwawidjaya</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item">Maps</li>
                        <li class="breadcrumb-item active">Edit Source</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container">
            <form action="{{ url('admin/umum/edit-maps/' . $maps->id) }}" method="POST" enctype="multipart/form-data">
                @if (isset($maps))
                    @method('PUT')
                @endif
                @csrf
                <div class="col">
                    <label for="source" class="form-label">Source Google Maps</label>
                    <input type="text" name="source" class="form-control" id="source" value="{{ $maps->source }}" required>
                </div>

                <div class="mt-3">
                    <button id="btn-edit-maps" type="submit" class="btn btn-block btn-success">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
