@extends('layout.app')

@section('title', 'Booking Lapangan Dimana Saja')

@section('content')
    <div class="container container-booking min-vh-100 mb-5">
        <a href="/" class="text-decoration-none text-color-secondary poppins-semibold">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
        <div class="d-flex flex-column row-gap-4 mt-3">
            <div class="col-12">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-inner rounded">
                        @forelse ($court as $key => $item)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="max-height: 400px">
                                <img src="{{ asset(Storage::url($item->image)) }}" class="d-block w-100 h-100 object-fit-cover"
                                    alt="{{ $item->court->name }}">
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-12">
                <div class="timeStart"></div>
                <h1 class="mt-3">{{ $court[0]->court->name }}</h1>
                <form action="{{ url('/booking-lapangan') }}" method="POST" enctype="multipart/form-data">
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

                    <div class="col mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="col mb-3">
                        <label for="datepick" class="form-label">Pilih hari</label>
                        <input id="datepick" name="datepick" type="date" min="{{ $startDate }}"
                            max="{{ $endDate }}" class="form-control" required>
                    </div>

                    <div class="col mb-3">
                        <label for="collapseThree" class="form-label">Jadwal Tersedia</label>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <a id="pilih-jadwal" class="form-control text-left collapsed text-decoration-none"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Pilih Jadwal
                                    </a>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div id="chooseDate" class="fw-bold fst-italic">**Pilih tanggal terlebih dahulu
                                        </div>
                                        <div class="d-flex flex-wrap gap-2 show-time">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-3">
                        <label for="payment_metode" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" name="payment_metode" required>
                            <option selected>Pilih metode</option>
                            <option value="Bank">Transfer Bank</option>
                            <option value="e-Wallet">e-Wallet</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-center my-5">
                        <button id="sewa-sekarang" type="submit" class="btn-booking border-0 px-5 py-3 poppins-semibold rounded-5">Sewa
                            Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (Session::has('checkLogin'))
        <script>
            Swal.fire({
                // title: 'Harap Login',
                text: "Login terlebih dahulu untuk menyewa lapangan",
                showCloseButton: true,
                showCancelButton: false,
                customClass: {
                    confirmButton: "btn-booking focus-none py-3 poppins-semibold rounded-5"
                },
                confirmButtonText: '<a class="text-decoration-none btn-booking w-100 h-100 rounded-5 px-5 py-3" href="{{ url('/login') }}">Login sekarang</a>',
                imageUrl: "{{ asset('assets/dist/img/login/login-cuate.png') }}",
                imageWidth: 350,
                imageHeight: 350,
                imageAlt: "Custom image"
                // timer: 3000,
                // timerProgressBar: true,
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
            console.log('hari ini: ' + today);
            console.log(isWeekend(date));

            // menampilkan jadwal berdasarkan weekday / weekend
            if (isWeekend(date) == true) {
                console.log("tampilkan jadwal weekend");
                $.ajax({
                    type: "POST",
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
            } else {
                console.log("tampilkan jadwal weekday");
                $.ajax({
                    type: "POST",
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
