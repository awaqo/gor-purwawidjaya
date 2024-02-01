@extends('layout.app-admin')

@section('title', 'Booking Manual')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manual Booking</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item active">Manual Booking</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            {{-- Lapangan --}}
            <div class="h4 mt-3">Daftar Lapangan</div>
            <div class="row justify-content-center">
                @foreach ($courtList as $item)
                    <a dusk="{{ $item->court->id }}_{{ $item->court->slug }}" href="{{ url('admin/manual-booking/' . $item->court->id . '/' . $item->court->slug) }}"
                        class="col-12 col-md-4 link-underline link-underline-opacity-0">
                        <div class="card">
                            <img src="{{ asset(Storage::url($item->image)) }}" class="card-img-top" alt="{{ $item->court_name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->court->court_name }}</h5>
                                <p class="card-text">
                                    <span style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {!! $item->court->description !!}
                                    </span>    
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- List orang booking --}}
            <div class="mt-3 pb-5 table-responsive">
                <div class="h4">List Booking</div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-primary-subtle text-center">Lapangan</th>
                            <th scope="col" class="bg-primary-subtle text-center">Tanggal Main</th>
                            <th scope="col" class="bg-primary-subtle text-center">Nama Pembooking</th>
                            <th scope="col" class="bg-primary-subtle text-center">Jam Main</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($lastBook == null)
                            <tr>
                                <td colspan="4" class="text-center">Belum ada transaksi</td>
                            </tr>
                        @else
                            @forelse ($Transaction as $data)
                                @if ($data->payment_status == 'paid' && $data->order_status !== 'cancelled' && $data->order_status !== 'completed')
                                    <tr class="text-center">
                                        <td id="{{ $data->booking_id }}" class="bk_id">{{ $data->court_name }}</td>
                                        <td><span class="badge bg-success booking_date">{{ date('Y-m-d', strtotime($data->date)) }}</span></td>
                                        <td>{{ $data->booking_name }}</td>
                                        <td>
                                            @foreach ($BkTime->where('booking_id', $data->booking_id) as $item)
                                                <span class="badge bg-primary">{{ $item->play_time }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada transaksi</td>
                                </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const trx = {!! json_encode($Transaction->toArray()) !!};
        const booking = {!! json_encode($BkTime->toArray()) !!};
        const timer = {!! json_encode($Timer->toArray()) !!};
        var bookDate = document.querySelector(".booking_date").textContent;
        var bkId = document.querySelector(".bk_id");
        var bookingId = bkId.getAttribute('id');

        let today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        var currentHour = today.getHours();

        // tambah 0 jika hari < 10
        if (dd < 10) {
            dd = '0' + dd;
        } 
        // tambah 0 jika bulan < 10
        if (mm < 10) {
            mm = '0' + mm;
        }

        today = yyyy + '-' + mm + '-' + dd;
        
        $(document).ready(() => {
            updateBookingList();
        });

        function updateBookingList() {
            for (a = 0; a < trx.length; a++) {
                var bookId = trx[a].booking_id;
                if (trx[a].payment_status == 'paid' && trx[a].order_status !== 'completed' && trx[a].order_status !== 'cancelled') {
                    var bid = trx[a].booking_id;
                    console.log(bid);
                    for (b = 0; b < booking.length; b++) {
                        var bD = booking[b].date;
                        if (today == bD && booking[b].booking_id == bid) {
                            console.log(bD);
                            console.log(booking[b].schedule_id);
                            var scheduleId = booking[b].schedule_id;
                        }
                    }
                }
            }

            for (c = 0; c < timer.length; c++) {
                if (timer[c].id == scheduleId) {
                    var timeEnd = timer[c].timeEnd;
                }
            }

            if (currentHour >= timeEnd) {
                console.log('waktu booking selesai');
                $.ajax({
                    type: "POST",
                    url: "{{ route('update-status') }}",
                    data: {
                        bookingid: bookId,
                    },
                    success: (res) => {
                    },
                });
            } else {
                console.log('booking belum selesai');
            }
        }
    </script>
@endpush