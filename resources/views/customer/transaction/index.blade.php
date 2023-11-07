@extends('layout.app')

@section('title', 'Booking Lapangan Dimana Saja')

@section('content')
    <div class="my-5">
        <div class="col">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
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

        <h1 class="mt-3">{{ $court[0]->name }}</h1>

        {{-- Jadwal yang tersedia --}}
        @php
            $disabled = '';
        @endphp
        {{ $date }}
        @if ($weekday == 'Min' || $weekday == 'Sab')
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
        @endif
    </div>
@endsection
