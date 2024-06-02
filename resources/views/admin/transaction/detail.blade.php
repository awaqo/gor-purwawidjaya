@extends('layout.app-admin')

@section('title', 'Detail Transaksi')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.transaction') }}"
                        class="btn btn-outline-primary px-3 border border-light-subtle">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                    </a>
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
            <div class="mb-4">
                <div class="fw-semibold fs-5">Data Pembayaran</div>
                @if ($dataPayment !== null && $detailTransaction->user_id !== 1)
                    <div class="row mt-2 px-2 gap-2">
                        <div class="px-3 py-3 bg-light border border-info rounded col-lg-5 col-12 col-md-5">
                            <div>Nominal</div>
                            <div class="fw-semibold fs-5">Rp {{ number_format($dataPayment->pay_amount, 0, ',', '.') }}
                            </div>
                        </div>
                        <div
                            class="px-3 py-3 bg-light border border-info rounded col-lg-5 col-12 col-md-5 d-flex flex-row align-items-center">
                            <div class="col-3">
                                <img src="{{ asset(Storage::url($dataPayment->payment_image)) }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div>
                                <a href="#" class="btn btn-outline-light text-dark" data-bs-toggle="modal" data-bs-target="#buktiBayar">
                                    Lihat bukti pembayaran
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="buktiBayar" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="buktiBayarLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <button type="button" class="btn-close mt-3 me-3" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="px-4">
                                                    <img src="{{ asset(Storage::url($dataPayment->payment_image)) }}" class="d-block w-100" alt="foto-bukti-pembayaran">
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($detailTransaction->user_id == 1)
                    <div class="px-3 py-3 bg-light border border-info rounded col-lg-3 col-6">
                        Pembayaran langsung di tempat
                    </div>
                @else
                    <div class="px-3 py-3 bg-light border border-info rounded col-lg-3 col-6">
                        Pelanggan belum upload bukti pembayaran
                    </div>
                @endif
            </div>
            <div class="mb-3 table-responsive">
                {{-- <div class="h2">Perlu Konfirmasi</div> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-primary-subtle text-center">Nama User</th>
                            <th scope="col" class="bg-primary-subtle text-center">Lapangan</th>
                            <th scope="col" class="bg-primary-subtle text-center">Tanggal Main</th>
                            <th scope="col" class="bg-primary-subtle text-center">Jam Main</th>
                            <th scope="col" class="bg-primary-subtle text-center">Status Pembayaran</th>
                            <th scope="col" class="bg-primary-subtle text-center">Status Booking</th>
                            <th scope="col" class="bg-primary-subtle text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>{{ $detailTransaction->name }}</td>
                            <td>{{ $detailTransaction->court_name }}</td>
                            <td><span
                                    class="badge bg-success">{{ date('d-m-Y', strtotime($detailTransaction->date)) }}</span>
                            </td>
                            <td>
                                @foreach ($BkTime->where('booking_id', $detailTransaction->booking_id) as $item)
                                    <span class="badge bg-primary">{{ $item->play_time }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if ($detailTransaction->payment_status == 'paid')
                                    <span class="badge badge-success">Sudah bayar</span>
                                @else
                                    <span class="badge badge-warning">Belum bayar</span>
                                @endif
                            </td>
                            <td>
                                @if ($detailTransaction->order_status == 'awaiting_payment')
                                    <span class="badge badge-warning">Menunggu pembayaran</span>
                                @elseif ($detailTransaction->order_status == 'need_confirm')
                                    <span class="badge badge-info">Perlu konfirmasi admin</span>
                                @elseif ($detailTransaction->order_status == 'confirmed')
                                    <span class="badge badge-info">Sedang berlangsung</span>
                                @elseif ($detailTransaction->order_status == 'completed')
                                    <span class="badge badge-success">Selesai</span>
                                @else
                                    <span class="badge badge-danger">Dibatalkan</span>
                                @endif
                            </td>
                            <td>
                                @if ($detailTransaction->order_status == 'confirmed')
                                    <a href="javascript:void(0);" id="end-modal" data-bs-toggle="modal"
                                        data-bs-target="#endTransaction">Selesaikan Transaksi</a>
                                @elseif ($detailTransaction->order_status == 'need_confirm')
                                    <a href="javascript:void(0);" id="confirm-modal" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal">Konfirmasi</a>
                                @elseif ($detailTransaction->order_status == 'awaiting_payment')
                                    <div>Menunggu Pembayaran</div>
                                @elseif ($detailTransaction->order_status == 'completed')
                                    <div></div>
                                @else
                                    <div></div>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal -->

    {{-- Konfirmasi transaksi --}}
    <div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    {{-- <h1 class="modal-title fs-5" id="confirmModalLabel">Konfirmasi Booking</h1> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="fw-bold mb-2">Yakin melakukan konfirmasi booking?</div>
                    <div class="text-secondary">Pastikan nominal & bukti pembayaran sudah sesuai</div>
                </div>
                <div class="modal-footer border-0">
                    <a href="{{ route('admin.transaction.confirm', $detailTransaction->id) }}" id="confirm-btn"
                        class="btn btn-primary px-5">Yakin</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Selesaikan Transaksi --}}
    <div class="modal fade" id="endTransaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="endTransactionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    {{-- <h1 class="modal-title fs-5" id="endTransactionLabel">Selesaikan Transaksi</h1> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="fw-bold mb-2">Yakin selesaikan transaksi?</div>
                    <div class="text-secondary">Pastikan pelanggan sudah selesai bermain</div>
                </div>
                <div class="modal-footer border-0">
                    <a href="{{ route('admin.transaction.end', $detailTransaction->id) }}" id="end-btn"
                        class="btn btn-primary px-5">Yakin</a>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('successConfirm'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Konfirmasi Booking Berhasil',
                showConfirmButton: true,
            })
        </script>
    @elseif (Session::has('endTransaction'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Transaksi Selesai',
                showConfirmButton: true,
            })
        </script>
    @endif
@endsection
