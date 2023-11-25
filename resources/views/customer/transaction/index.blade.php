@extends('layout.app')

@section('title', 'Booking Lapangan Dimana Saja')

@section('content')
    <div class="my-5">
        <div class="col-md-10 mx-auto">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner rounded">
                    <div class="carousel-item active" style="height: 80vh">
                        <img src="{{ asset(Storage::url($court[0]->image)) }}" class="d-block w-100 h-100 object-fit-fill"
                            alt="a">
                    </div>
                    <div class="carousel-item" style="height: 80vh">
                        <img src="{{ asset(Storage::url($court[1]->image)) }}" class="d-block w-100 h-100 object-fit-fill"
                            alt="s">
                    </div>
                    <div class="carousel-item" style="height: 80vh">
                        <img src="{{ asset(Storage::url($court[2]->image)) }}" class="d-block w-100 h-100 object-fit-fill"
                            alt="d">
                    </div>
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
        <div class="col-md-10 mx-auto">
            <h1 class="mt-3">{{ $court[0]->name }}</h1>

            {{-- Jadwal yang tersedia --}}

            {{-- 
                - middleware check login ketika tekan tombol booking lapangan
                ==> next <== 
                - bikin migration baru untuk data jadwal yang terbooking (done)
                - cek ulang sistem booking 
                    - price (done)
                    - disabled jadwal yang sudah terbooking sesuai hari(done)
                - benerin show jadwal booked (done)
                - update ulang availability setelah ganti hari (done)
                - TODO: ubah jadwal yang tersedia menyesuaikan weekend / weekday setelah user memilih hari melalui datepicker
                
                --}}

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
                {{-- @foreach ($checkBooked as $item)
                    <input type="hidden" id="bookDate" value="{{ $item->date }}">
                @endforeach --}}

                <div class="col mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>

                <div class="col mb-3">
                    <label for="datepick" class="form-label">Pilih hari</label>
                    <input id="datepick" name="datepick" type="date" min="{{ $startDate }}" max="{{ $endDate }}"
                        class="form-control">
                </div>

                <div class="col mb-3">
                    <label for="collapseThree" class="form-label">Jadwal Tersedia</label>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <a class="form-control text-left collapsed text-decoration-none" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Pilih Jadwal
                                </a>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="d-flex flex-wrap">
                                        @foreach ($schedules as $schedule)
                                            <div class="col-md-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sch schedule-{{ $schedule->id }}"
                                                        type="checkbox" id="schedule-{{ $schedule->id }}"
                                                        name="selectedSchedule[]" value="{{ $schedule->id }}">
                                                    <label class="form-check-label" for="schedule-{{ $schedule->id }}">
                                                        <div class="d-flex">
                                                            <div>{{ $schedule->timeStart }}.00</div>
                                                            <div>&nbsp;-&nbsp;</div>
                                                            <div>{{ $schedule->timeEnd }}.00</div>
                                                        </div>
                                                        <div class="text-center">
                                                            Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{ $startDate }}

                <div class="col mb-3">
                    <select class="form-select" name="payment_metode" required>
                        <option selected>Pilih metode</option>
                        <option value="Bank">Transfer Bank</option>
                        <option value="e-Wallet">e-Wallet</option>
                    </select>
                </div>

                <div class="col">
                    <button type="submit" class="btn btn-outline-primary">Booking</button>
                    {{-- <a href="{{ url('/booking') }}" class="btn btn-outline-primary">Booking</a> --}}
                </div>
            </form>
        </div>
    </div>

    @if (Session::has('message'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Harap Login',
                text: "{{ Session::get('message') }}",
                showCancelButton: true,
                showConfirmButton: false,
                footer: '<a href="{{ url('/login') }}">Login sekarang</a>'
                // timer: 3000,
                // timerProgressBar: true,
            })
        </script>
    @endif
@endsection

@push('scripts')
    <script>
        var schedule = {!! json_encode($schedules->toArray()) !!};
        // var checkBooking = {!! json_encode($checkBooked->toArray()) !!};

        let today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        var hour = today.getHours();
        today = yyyy + '-' + mm + '-' + dd;

        $(document).ready(() => {
            
        });

        $('#datepick').on("input", function() {
            let date = $('#datepick').val();

            console.log(today);
            console.log(date);

            if (date != today) {
                console.log('hari tidak sama');
                $('.sch').attr('disabled', false);
            } else {
                console.log('hari sama');

                for (var i = 0; i < schedule.length; i++) {
                    if (schedule[i].timeStart < hour && schedule[i].timeEnd <= hour) {
                        let scid = 'schedule-' + schedule[i].id;
                        $('.' + scid).attr('disabled', true);
                    }
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('check-sch') }}",
                    data: {
                        date: date
                    },
                    success: (res) => {
                        console.log(res);
                        let resLength = Object.keys(res).length;
                        console.log(resLength);
                        for (var i = 0; i < resLength; i++) {
                            console.log(i);
                            console.log('schedule-' + res[i].schedule_id);
                            console.log('schedule-' + res[i].date);
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
