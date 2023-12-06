@extends('layout.app')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div>riwayat pesanan</div>
    @forelse ($transaction as $data)
        <hr>

        <div class="d-flex justify-content-between">
            <div>
                <div>Transaksi : {{ $data->created_at->isoFormat('D-MMM-Y - H:m') }} WIB</div>
                <div>ID Pesanan : <span class="badge bg-info">{{ substr($data->id, -12) }}</span></div>
                <div>Lapangan : {{ $data->court->name }}</div>
                <div>Nama pembooking : {{ $data->booking->name }}</div>
                <div>Total : <span class="fw-bold">Rp {{ number_format($data->total, 0, ',', '.') }}</span></div>
            </div>
    
            <div class="col-md-4 d-flex flex-column justify-content-between">
                <div class="align-self-end">
                    @if ($data->payment_status == 'unpaid')
                        @if ($payment->where('transactions_id', $data->id)->first() !== null)
                            <div>Menunggu Konfirmasi Pengelola GOR</div>
                        @else
                            <div class="badge bg-danger">Belum bayar</div>
                        @endif
                    @elseif ($data->payment_status == 'paid')
                        @if ($data->order_status == 'need_confirm')
                            <div class="badge bg-warning">
                                Menunggu Konfirmasi Pengelola GOR
                            </div>
                        @elseif ($data->order_status == 'confirmed')
                            <div>
                                Proses booking selesai, Anda sudah dapat bermain
                            </div>
                        @elseif ($data->order_status == 'completed')
                            <div>
                                Transaksi Selesai
                            </div>
                        @endif
                    @elseif ($data->order_status == 'cancelled')
                        <span>
                            Transaksi Dibatalkan
                        </span>
                    @endif
                </div>
    
                <div class="align-self-end">
                    @if ($payment->where('transaction_id', $data->id)->first() == null && $data->order_status !== 'cancelled')
                        <div class="mb-1">
                            <!-- Button trigger modal -->
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Bayar Sekarang
                            </a>
                        </div>
    
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Selesaikan Proses Booking</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>Silahkan transfer ke :</div>
                                        <div>Bank</div>
                                        <div class="fw-bold">123456789876</div>
                                        <div>a/n <span class="fw-bold">Qweqw Asdas</span></div>
                                        <div>Nominal : <span class="fw-bold">Rp
                                                {{ number_format($data->total, 0, ',', '.') }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
    
                    @if ($data->payment_status == 'unpaid')
                        <div>
                            <a class="btn btn-outline-primary" href="{{ route('page.upload-pembayaran', $data->id) }}">Upload
                                Bukti
                                Pembayaran</a>
                        </div>
                    @else
                        <div class="bg-success text-white rounded-2 py-2 px-5">Booking berhasil</div>
                    @endif
                </div>
            </div>
        </div>
        <hr>

    @empty
        <div>Belum ada transaksi</div>
    @endforelse

    @if (Session::has('successUp'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Upload',
                text: "{{ Session::get('successUp') }}",
                confirmButtonText: 'OK',
                timer: 6000,
                timerProgressBar: true,
            })
        </script>
    @endif
@endsection
