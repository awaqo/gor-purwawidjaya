@extends('layout.app-admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="text-center pb-3">
                            <div class="fs-5 mb-2 pt-3">Transaksi</div>
                            <h3 class="">{{ $transaction->count() }}</h3>
                        </div>
                        {{-- <div class="icon">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                        </div> --}}
                        <div class="small-box-footer py-1">
                            <a href="{{ route('admin.transaction') }}" class="text-white">
                                <strong class="badge fs-6 rounded-pill bg-danger">{{ $needConfirm }}</strong> Transaksi perlu konfirmasi
                            </a>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="text-center pb-3">
                            <div class="fs-5 mb-2 pt-3">Lapangan</div>
                            <h3 class="">{{ $court->count() }}</h3>
                        </div>
                        {{-- <div class="icon">
                            <i class="fa-solid fa-table-columns"></i>
                        </div> --}}
                        <div class="small-box-footer py-3"></div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="text-center pb-3">
                            <div class="fs-5 mb-2 pt-3">Pendapatan Bulanan</div>
                            <h3 class="">Rp {{ number_format($monthlyIncome, 0, ',', '.') }}</h3>
                        </div>
                        {{-- <div class="icon">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div> --}}
                        <div class="small-box-footer py-1">
                            <p class="m-0 fw-semibold text-white">- {{ date('F', strtotime($currentMonth)) }} -</p>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                {{-- <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div> --}}
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                {{-- Transaksi Masuk --}}
                <div class="mb-3 table-responsive">
                    <div class="h2">Transaksi Masuk</div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="bg-primary-subtle text-center">Nama User</th>
                                <th scope="col" class="bg-primary-subtle text-center">Lapangan</th>
                                <th scope="col" class="bg-primary-subtle text-center">Tanggal</th>
                                <th scope="col" class="bg-primary-subtle text-center">Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inTransaction as $data)
                                <tr class="text-center">
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->court->court_name }}</td>
                                    <td>{{ $data->created_at->format('d/m/Y - H:i') }} WIB</td>
                                    <td>
                                        @if ($data->payment_status == 'unpaid')
                                            <span class="badge badge-warning">Belum Bayar</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">Belum ada transaksi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- /.Transaksi Masuk --}}

                {{-- Butuh konfirmasi --}}
                <div class="mb-3 table-responsive">
                    <div class="h2">Perlu Konfirmasi</div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="bg-primary-subtle text-center">Nama User</th>
                                <th scope="col" class="bg-primary-subtle text-center">Lapangan</th>
                                <th scope="col" class="bg-primary-subtle text-center">Tanggal</th>
                                <th scope="col" class="bg-primary-subtle text-center">Status Pembayaran</th>
                                <th scope="col" class="bg-primary-subtle text-center">Status Pesanan</th>
                                <th scope="col" class="bg-primary-subtle text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($confirmTransaction as $data)
                                <tr class="text-center">
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->court->court_name }}</td>
                                    <td>{{ $data->created_at->format('d/m/Y - H:i') }} WIB</td>
                                    <td>
                                        @if ($data->payment_status == 'paid')
                                            <span class="badge badge-success">Sudah Bayar</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->order_status == 'need_confirm')
                                            <span class="badge badge-warning">Perlu Konfirmasi Admin</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.transaction.detail', $data->id) }}">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="6">Tidak ada transaksi yang perlu dikonfirmasi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- /.Butuh konfirmasi --}}
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    @if (Session::has('message'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Login Berhasil',
                text: "{{ Session::get('message') }}",
                showConfirmButton: false,
                toast: true,
                timer: 3000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('islogin'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                text: "{{ Session::get('islogin') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('CustArea'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: "Customer Area",
                text: "{{ Session::get('CustArea') }}",
                timer: 3000,
                timerProgressBar: true,
            })
        </script>
    @elseif (Session::has('successBooking'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Booking Berhasil',
                text: "{{ Session::get('successBooking') }}",
                confirmButtonText: 'OK',
            })
        </script>
    @endif
@endsection
