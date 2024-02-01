@extends('layout.app-admin')

@section('title', 'Booking Manual')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('admin.manual-booking') }}" class="btn btn-outline-primary px-3 border border-light-subtle">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <h1 class="fw-semibold">{{ $court[0]->court->court_name }}</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span class="text-primary">Admin</span></li>
                        <li class="breadcrumb-item">Manual Booking</li>
                        <li class="breadcrumb-item active">Pilih Jadwal Main</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="col-md-10 mx-auto pb-5">
                <div class="timeStart"></div>
                <h1 class="mt-3">{{ $court[0]->court->name }}</h1>
                <form action="{{ route('admin.bookCourt') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($booked_schedule->count() < 1)
                        @php
                            $booked_id = 1;
                        @endphp
                    @else
                        @php
                            $booked_id = $latest->booking_id;
                            $booked_id += 1;
                        @endphp
                    @endif
                    <input type="hidden" name="court_id" value="{{ $court[0]->court_id }}">
                    <input type="hidden" name="booked_id" value="{{ $booked_id }}">
        
                    <div class="row">
                        <div class="col mb-3">
                            {{-- <label for="name" class="form-label">Nama</label> --}}
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama" required>
                        </div>
            
                        <div class="col mb-3">
                            {{-- <label for="datepick" class="form-label">Pilih hari</label> --}}
                            <input id="datepick" name="datepick" type="date" min="{{ $startDate }}" max="{{ $endDate }}"
                                class="form-control" required>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col mb-3">
                            {{-- <label for="collapseThree" class="form-label">Jadwal Tersedia</label> --}}
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <a id="pilih-jadwal" class="form-control text-left collapsed text-decoration-none text-secondary" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Pilih Jadwal
                                        </a>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div id="chooseDate" class="fw-bold fst-italic">**Pilih tanggal terlebih dahulu</div>
                                            <div class="d-flex flex-wrap gap-2 show-time">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="col mb-3">
                            {{-- <label for="payment_metode" class="form-label">Metode Pembayaran</label> --}}
                            <select class="form-select" name="payment_metode" required>
                                <option disabled selected>Pilih metode</option>
                                <option value="Bank">Transfer Bank</option>
                                <option value="e-Wallet">e-Wallet</option>
                            </select>
                        </div>
                    </div>
        
                    <div class="d-flex justify-content-center mt-3">
                        <button id="sewa-sekarang" type="submit" class="btn btn-danger px-5 rounded-5">Sewa Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @if (Session::has('checkLogin'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Harap Login',
                text: "{{ Session::get('checkLogin') }}",
                showCancelButton: true,
                showConfirmButton: false,
                footer: '<a href="{{ url('/login') }}">Login sekarang</a>'
            })
        </script>
    @endif
@endsection

@push('scripts')
    <script>
        const schedule = {!! json_encode($schedules->toArray()) !!};
        
        let today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        var hour = today.getHours();

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
            
        });

        // cek weekend / weekday berdasarkan datepicker
        var isWeekend = function(date1) {
            var dt = new Date(date1);
            return dt.getDay() == 6 || dt.getDay() == 0;
        }

        $('#datepick').on("input", function() {
            let date = $('#datepick').val();
            console.log('hari ini: '+today);
            console.log(isWeekend(date));

            // menampilkan jadwal berdasarkan weekday / weekend
            if (isWeekend(date) == true) {
                console.log("tampilkan jadwal weekend");
                $.ajax({
                    type:"POST",
                    url: "{{ route('show-sch') }}",
                    data: {
                        day: "weekend",
                    },
                    success: (res) => {
                        const cD = document.querySelector('#chooseDate');
                        const target = document.querySelector('.show-time');
                        cD.innerHTML = '';
                        target.innerHTML = '';
                        let output = '';
                        res.forEach(item => {
                            let formatedPrice = new Intl.NumberFormat('id-ID', {
                                minimumFractionDigits: 0
                            }).format(item.price);
                            output = `
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input dusk="test-${item.id}" class="form-check-input sch schedule-${item.id}"
                                            type="checkbox" id="schedule-${item.id}"
                                            name="selectedSchedule[]" value="${item.id}">
                                        <label class="form-check-label" for="schedule-${item.id}">
                                            <div class="d-flex">
                                                <div>${item.timeStart}.00</div>
                                                <div>&nbsp;-&nbsp;</div>
                                                <div>${item.timeEnd}.00</div>
                                            </div>
                                            <div class="text-center">
                                                Rp ${formatedPrice}
                                            </div>
                                        </label>
                                    </div>  
                                </div>
                            `;
                            target.innerHTML += output
                        });
                    }
                });
            } 
            
            else {
                console.log("tampilkan jadwal weekday");
                $.ajax({
                    type:"POST",
                    url: "{{ route('show-sch') }}",
                    data: {
                        day: "weekday",
                    },
                    success: (res) => {
                        const cD = document.querySelector('#chooseDate');
                        const target = document.querySelector('.show-time');
                        cD.innerHTML = '';
                        target.innerHTML = '';
                        let output = '';
                        res.forEach(item => {
                            let formatedPrice = new Intl.NumberFormat('id-ID', {
                                minimumFractionDigits: 0
                            }).format(item.price);
                            output = `
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input dusk="test-${item.id}" class="form-check-input sch schedule-${item.id}"
                                            type="checkbox" id="schedule-${item.id}"
                                            name="selectedSchedule[]" value="${item.id}">
                                        <label class="form-check-label" for="schedule-${item.id}">
                                            <div class="d-flex">
                                                <div>${item.timeStart}.00</div>
                                                <div>&nbsp;-&nbsp;</div>
                                                <div>${item.timeEnd}.00</div>
                                            </div>
                                            <div class="text-center">
                                                Rp ${formatedPrice}
                                            </div>
                                        </label>
                                    </div>  
                                </div>
                            `;
                            target.innerHTML += output
                        });
                    }
                });
            }

            // cek ketersediaan jadwal berdasarkan hari dari datepicker
            if (date != today) {
                console.log('hari tidak sama');
                $('.sch').attr('disabled', false);
                $.ajax({
                    type: "POST",
                    url: "{{ route('check-sch') }}",
                    data: {
                        date: date
                    },
                    success: (res) => {
                        let resLength = Object.keys(res).length;
                        for (var i = 0; i < resLength; i++) {
                            let schid = 'schedule-' + res[i].schedule_id;
                            if (res[i].date = date && res[i].court_id == {{ $court[0]->court_id }}) {
                                $('.' + schid).attr('disabled', true)
                            }
                        }
                    }
                });
            } else {
                console.log('hari sama');
                $.ajax({
                    type: "POST",
                    url: "{{ route('check-sch') }}",
                    data: {
                        date: date
                    },
                    success: (res) => {
                        let resLength = Object.keys(res).length;
                        for (var i = 0; i < schedule.length; i++) {
                            if (schedule[i].timeStart < hour && schedule[i].timeEnd <= hour) {
                                let scid = 'schedule-' + schedule[i].id;
                                $('.' + scid).attr('disabled', true);
                            }
                        }
                        for (var i = 0; i < resLength; i++) {
                            let schid = 'schedule-' + res[i].schedule_id;
                            if (res[i].date = date && res[i].court_id == {{ $court[0]->court_id }}) {
                                $('.' + schid).attr('disabled', true)
                            }
                        }
                        if (resLength < 1) {
                            for (var i = 0; i < schedule.length; i++) {
                                if (schedule[i].timeStart < hour && schedule[i].timeEnd <= hour) {
                                    let scid = 'schedule-' + schedule[i].id;
                                    $('.' + scid).attr('disabled', true);
                                }
                            }
                        }
                    }
                });
            }
        })
    </script>
@endpush