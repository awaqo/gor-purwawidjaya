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
            @php
                $disabled = '';
            @endphp
            {{ $date }}

            {{-- 
                - middleware check login ketika tekan tombol booking lapangan
                ==> next <== 
                - bikin migration baru untuk data jadwal yang terbooking (done)
                - cek ulang sistem booking 
                    - price (done)
                    - disabled jadwal yang sudah terbooking (done(?))
                - benerin show jadwal booked (done(?))
                - update ulang availability setelah jam habis
                
                --}}
            <div class="h2">Jadwal Tersedia : @if ($weekday == 'Min' || $weekday == 'Sab')
                    Weekend
                @else
                    Weekday
                @endif
            </div>
            <form action="{{ url('/booking-lapangan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($booked_schedule->count() < 1)
                    @php
                        $booked_id = 1;
                    @endphp
                @else
                    @php
                        $booked_id = $latest->id;
                    @endphp
                @endif
                <input type="hidden" name="court_id" value="{{ $court[0]->court_id }}">
                <input type="hidden" name="booked_id" value="{{ $booked_id }}">

                {{-- @forelse ($checkBooked as $item)
                    @php
                        $checkbook = $item->timeStart;
                        $checkcourt = $item->court_id;
                    @endphp
                    {{ $checkbook }}
                @empty
                    @php
                        $checkbook = '';
                        $checkcourt = '';
                    @endphp
                @endforelse --}}
                <div class="d-flex flex-wrap">
                    @foreach ($schedules as $schedule)
                        @php
                            $disabled = 'disabled';
                            $enable = '';
                        @endphp

                        <div></div>
                        {{-- {{ $schedule }} --}}
                        <div class="col-md-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="schedule-{{ $schedule->id }}"
                                    name="selectedSchedule[]" value="{{ $schedule->id }}"
                                    @forelse ($checkBooked as $item) @php
                                            $start = $item->timeStart;
                                            $end = $item->timeEnd;
                                        @endphp
                                        @if (($schedule->timeStart < $today && $schedule->timeEnd <= $today) ||
                                                ($schedule->timeStart == $start && $schedule->timeEnd == $end && $court[0]->court_id == $item->court_id)) 
                                            {{ $disabled }}
                                        @else
                                            {{ $enable }}
                                        @endif
                                    @empty

                                    @endforelse>
                                <label class="form-check-label" for="schedule-{{ $schedule->id }}">
                                    <div class="d-flex">
                                        <div>{{ $schedule->timeStart }}.00</div>
                                        <div>&nbsp;-&nbsp;</div>
                                        <div>{{ $schedule->timeEnd }}.00</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col">
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
            {{-- @if ($weekday == 'Min' || $weekday == 'Sab')
                <div class="h2">Jadwal Tersedia : Weekend</div>
                @foreach ($schedules as $schedule)
                    @if ($schedule->timeStart < $today && $schedule->timeEnd <= $today)
                        @php
                            $disabled = 'disabled';
                        @endphp
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="schedule-{{ $schedule->id }}"
                                value="option-{{ $schedule->id }}" {{ $disabled }}>
                            <label class="form-check-label" for="schedule-{{ $schedule->id }}">
                                <div class="d-flex">
                                    <div>{{ $schedule->timeStart }}.00</div>
                                    <div>&nbsp;-&nbsp;</div>
                                    <div>{{ $schedule->timeEnd }}.00</div>
                                </div>
                            </label>
                        </div>
                    @else
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="schedule-{{ $schedule->id }}"
                                value="option-{{ $schedule->id }}">
                            <label class="form-check-label" for="schedule-{{ $schedule->id }}">
                                <div class="d-flex">
                                    <div>{{ $schedule->timeStart }}.00</div>
                                    <div>&nbsp;-&nbsp;</div>
                                    <div>{{ $schedule->timeEnd }}.00</div>
                                </div>
                            </label>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="h2">Jadwal Tersedia : Weekday</div>
                @foreach ($schedules as $schedule)
                    @if ($schedule->timeStart < $today && $schedule->timeEnd <= $today)
                        @php
                            $disabled = 'disabled';
                        @endphp
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="schedule-{{ $schedule->id }}"
                                value="option-{{ $schedule->id }}" {{ $disabled }}>
                            <label class="form-check-label" for="schedule-{{ $schedule->id }}">
                                <div class="d-flex">
                                    <div>{{ $schedule->timeStart }}.00</div>
                                    <div>&nbsp;-&nbsp;</div>
                                    <div>{{ $schedule->timeEnd }}.00</div>
                                </div>
                            </label>
                        </div>
                    @else
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="schedule-{{ $schedule->id }}"
                                value="option-{{ $schedule->id }}">
                            <label class="form-check-label" for="schedule-{{ $schedule->id }}">
                                <div class="d-flex">
                                    <div>{{ $schedule->timeStart }}.00</div>
                                    <div>&nbsp;-&nbsp;</div>
                                    <div>{{ $schedule->timeEnd }}.00</div>
                                </div>
                            </label>
                        </div>
                    @endif
                @endforeach
            @endif --}}
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
    
@endpush
