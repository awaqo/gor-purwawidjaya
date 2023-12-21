@extends('layout.app-admin')

@section('title', 'Detail Transaksi')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transaksi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item">Transaksi</li>
                        <li class="breadcrumb-item active">Detail Transaksi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="mb-3 table-responsive">
                {{-- <div class="h2">Perlu Konfirmasi</div> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-secondary text-light text-center">Nama User</th>
                            <th scope="col" class="bg-secondary text-light text-center">Lapangan</th>
                            <th scope="col" class="bg-secondary text-light text-center">Tanggal</th>
                            <th scope="col" class="bg-secondary text-light text-center">Status Pembayaran</th>
                            <th scope="col" class="bg-secondary text-light text-center">Status Booking</th>
                            <th scope="col" class="bg-secondary text-light text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ dd($data) }}
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection