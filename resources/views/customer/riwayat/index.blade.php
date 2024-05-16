@extends('layout.app')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="container container-profil min-vh-100">
        <div class="d-flex flex-md-row flex-sm-column flex-wrap">
            @include('include.profile.sidebar-profil')

            <div class="col-12 col-md-8 col-lg-8 border rounded-4 p-4 p-lg-5">
                @forelse ($transaction as $data)
                    <div class="d-flex flex-column row-gap-3">
                        <div
                            class="d-flex flex-sm-column flex-column-reverse flex-md-row align-items-md-center flex-wrap row-gap-3">
                            <div class="col-12 col-md-6 col-lg-6">
                                ID Pesanan : <span class="badge bg-info">{{ substr($data->id, -12) }}</span>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="d-flex justify-content-center justify-content-md-end">
                                    @if ($data->payment_status == 'unpaid' && $data->order_status == 'awaiting_payment')
                                        @if ($payment->where('transactions_id', $data->id)->first() !== null)
                                            <div class="status-info poppins-bold text-center">Menunggu Konfirmasi Pengelola
                                                GOR
                                            </div>
                                        @else
                                            <div class="status-info poppins-bold text-center">Belum bayar</div>
                                        @endif
                                    @elseif ($data->payment_status == 'unpaid' && $data->order_status == 'cancelled')
                                        <div class="status-info text-color-red poppins-bold text-center">Booking dibatalkan</div>
                                    @elseif ($data->payment_status == 'paid')
                                        @if ($data->order_status == 'need_confirm')
                                            <div class="status-info poppins-bold text-center">
                                                Menunggu Konfirmasi Pengelola GOR
                                            </div>
                                        @elseif ($data->order_status == 'confirmed')
                                            <div class="status-info-done poppins-bold text-center">
                                                Proses booking selesai, Anda sudah dapat bermain
                                            </div>
                                        @elseif ($data->order_status == 'completed')
                                            <div class="status-info-done poppins-bold text-center">
                                                Transaksi Selesai
                                            </div>
                                        @endif
                                    @elseif ($data->order_status == 'cancelled')
                                        <span class="status-info poppins-bold text-center">
                                            Transaksi Dibatalkan
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center flex-wrap row-gap-3">
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="d-flex flex-column row-gap-1">
                                    <div class="poppins-semibold text-color-primary">Sewa {{ $data->court_name }}</div>
                                    <div class="poppins-medium text-color-secondary" style="font-size: 12px">
                                        {{ date('d M Y - H:m', strtotime($data->created_at)) }} WIB</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="d-flex justify-content-end">
                                    <div class="poppins-semibold text-color-red fs-5">Rp
                                        {{ number_format($data->total, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="d-flex flex-sm-column flex-md-row flex-wrap justify-content-md-end justify-content-sm-center row-gap-2">
                            <div class="col-12 col-md-6 col-lg-5 col-xl-3">
                                @if ($payment->where('transaction_id', $data->id)->first() == null && $data->order_status !== 'cancelled')
                                    <div class="d-md-flex justify-content-md-end">
                                        <!-- Button trigger modal -->
                                        <a href="javascript:void(0);"
                                            class="btn-pay-now poppins-semibold text-center me-xl-2" data-bs-toggle="modal"
                                            data-bs-target="#modalPay-{{ $data->booking_id }}">
                                            Bayar Sekarang
                                        </a>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalPay-{{ $data->booking_id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="modalPay-{{ $data->booking_id }}-Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header pt-5 border-0">
                                                    <div class="col-12 px-3 position-relative">
                                                        <div class="poppins-bold text-center fs-5">Detail Pemesanan</div>
                                                        <button type="button" class="btn-close position-absolute"
                                                            style="top: 10px; right: 20px" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex flex-column align-items-center row-gap-4">
                                                        <div class="col-12 col-md-12 col-lg-8">
                                                            {{-- detail pesanan --}}
                                                            <div
                                                                class="d-flex flex-row column-gap-2 justify-content-center">
                                                                <div class="col-5 ps-md-5">
                                                                    <div class="poppins-medium text-color-secondary">No
                                                                        Lapangan</div>
                                                                </div>
                                                                <div class="col-1">
                                                                    <div class="poppins-regular text-color-secondary">:
                                                                    </div>
                                                                </div>
                                                                <div class="col-5">
                                                                    <div class="poppins-semibold text-color-primary">
                                                                        {{ $data->court_name }}</div>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="d-flex flex-row column-gap-2 justify-content-center mt-2">
                                                                <div class="col-5 ps-md-5">
                                                                    <div class="poppins-medium text-color-secondary">Jam
                                                                        Main</div>
                                                                </div>
                                                                <div class="col-1">
                                                                    <div class="poppins-regular text-color-secondary">:
                                                                    </div>
                                                                </div>
                                                                <div class="col-5">
                                                                    @foreach ($BkTime->where('booking_id', $data->booking_id) as $item)
                                                                        <div
                                                                            class="poppins-semibold text-color-primary play-time">
                                                                            {{ $item->play_time }}</div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="d-flex flex-row column-gap-2 justify-content-center mt-2">
                                                                <div class="col-5 ps-md-5">
                                                                    <div class="poppins-medium text-color-secondary">Total
                                                                        Harga</div>
                                                                </div>
                                                                <div class="col-1">
                                                                    <div class="poppins-regular text-color-secondary">:
                                                                    </div>
                                                                </div>
                                                                <div class="col-5">
                                                                    <div class="poppins-semibold text-color-primary">Rp
                                                                        {{ number_format($data->total, 0, ',', '.') }}</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- metode pembayaran --}}
                                                        <div class="col-12 col-md-12 col-lg-8 px-2 mt-3">
                                                            <div class="poppins-bold text-center fs-5 mb-3"
                                                                style="color: #A9AEB4">Metode Pembayaran</div>
                                                            <div
                                                                class="d-flex flex-row justify-content-md-center flex-wrap gap-3">
                                                                <div class="d-flex flex-column row-gap-3">
                                                                    <div style="height: 28px; width: 91px">
                                                                        <img src="{{ asset('assets/dist/img/riwayat-pesan/bca.png') }}"
                                                                            class="img-fluid" alt="">
                                                                    </div>
                                                                    <div class="poppins-medium text-color-secondary"
                                                                        style="font-size: 12px">1987264 - Andri Hidayat
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-column row-gap-3">
                                                                    <div style="height: 28px; width: 71px">
                                                                        <img src="{{ asset('assets/dist/img/riwayat-pesan/bri.png') }}"
                                                                            class="img-fluid" alt="">
                                                                    </div>
                                                                    <div class="poppins-medium text-color-secondary"
                                                                        style="font-size: 12px">1234625 - Andri Hidayat
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-column row-gap-3">
                                                                    <div style="height: 28px; width: 117px">
                                                                        <img src="{{ asset('assets/dist/img/riwayat-pesan/dana.png') }}"
                                                                            class="img-fluid" alt="">
                                                                    </div>
                                                                    <div class="poppins-medium text-color-secondary"
                                                                        style="font-size: 12px">0857253417 - Andri Hidayat
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mt-4 mb-5">
                                                            {{-- <form action="{{ route('cancel-booking') }}" method="post">
                                                        
                                                        </form> --}}
                                                            <button
                                                                class="btn-cancel-book text-decoration-none px-5 py-3 mt-lg-4 rounded-5 poppins-semibold"
                                                                data-bs-target="#confirmCancelBooking-{{ $data->booking_id }}"
                                                                data-bs-toggle="modal">
                                                                Batalkan Pesanan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal konfirmasi cancel booking -->
                                    <div class="modal fade" id="confirmCancelBooking-{{ $data->booking_id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="confirmCancelBooking-{{ $data->booking_id }}-Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <button type="button" class="btn-close mt-3 me-3"
                                                        data-bs-toggle="modal" data-bs-target="#modalPay-{{ $data->booking_id }}" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex flex-column align-items-center row-gap-4">
                                                        <div class="col-12 col-md-12 col-lg-8">
                                                            <div
                                                                class="poppins-semibold text-color-primary text-center fs-5">
                                                                Anda yakin ingin membatalkan booking lapangan?
                                                            </div>
                                                        </div>

                                                        <div class="col mb-5">
                                                            <form action="{{ route('cancel-booking') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="transaction_id" value="{{ $data->id}}">
                                                                <button type="submit" class="btn-cancel-book text-decoration-none px-5 py-3 mt-lg-4 rounded-5 poppins-semibold">Yakin</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 col-md-6 col-lg-5 col-xl-3">
                                @if ($data->payment_status == 'unpaid' && $data->order_status == 'awaiting_payment')
                                    <div class="d-md-flex justify-content-md-end">
                                        <a class="btn-up-receipt poppins-semibold text-center" id="upload-bukti-btn"
                                            href="{{ route('page.upload-pembayaran', $data->id) }}">Upload Pembayaran</a>
                                    </div>
                                @elseif ($data->payment_status == 'unpaid' && $data->order_status == 'cancelled')
                                    
                                @else
                                    <div class="bg-success text-white rounded-2 py-2 text-center">Booking berhasil</div>
                                @endif
                            </div>
                        </div>

                        <div class="text-color-secondary">
                            <hr>
                        </div>
                    </div>
                @empty
                    <div class="poppins-semibold">Belum ada transaksi</div>
                @endforelse
            </div>
        </div>
    </div>

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
    @elseif (Session::has('cancelBooking'))
        <script>
            Swal.fire({
                icon: 'success',
                text: "{{ Session::get('cancelBooking') }}",
                confirmButtonText: 'OK',
                timer: 6000,
                timerProgressBar: true,
            })
        </script>
    @endif
@endsection

@push('scripts')
    <script>
        const target = '{{ route('home') }}';
        const cancel = document.querySelector("#btnCancelBook");
        cancel.addEventListener("click", () => {
            Swal.fire({
                icon: "warning",
                text: "Yakin ingin batalkan pesanan?",
                showCancelButton: true,
                confirmButtonText: "Yakin",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(target);
                }
            });
        });
    </script>
@endpush
