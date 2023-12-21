@extends('layout.app-admin')

@section('title', 'Transaksi Booking Lapangan')

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
                        <li class="breadcrumb-item active">Transaksi</li>
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
                        @forelse ($transaction as $data)
                            <tr class="text-center">
                                <td class="align-middle">{{ $data->user->name }}</td>
                                <td class="align-middle">{{ $data->court->court_name }}</td>
                                <td class="align-middle">{{ $data->created_at->format('d/m/Y - H:i') }} WIB</td>
                                <td class="align-middle">
                                    @if ($data->payment_status == 'paid')
                                        <span class="badge badge-success">Sudah bayar</span>
                                    @else
                                        <span class="badge badge-warning">Belum bayar</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if ($data->order_status == 'awaiting_payment')
                                        <span class="badge badge-warning">Menunggu pembayaran</span>
                                    @elseif ($data->order_status == 'need_confirm')
                                        <span class="badge badge-info">Perlu konfirmasi admin</span>
                                    @elseif ($data->order_status == 'confirmed')
                                        <span class="badge badge-info">Sedang berlangsung</span>
                                    @elseif ($data->order_status == 'completed')
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.transaction.detail', $data->id) }}" class="btn btn-primary">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">Seluruh transaksi sudah dikonfirmasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection