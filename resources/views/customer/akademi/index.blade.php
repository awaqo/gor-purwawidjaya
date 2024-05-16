@extends('layout.app')

@section('title', 'Informasi Akademi')

@section('content')
    <div class="container container-competition min-vh-100 px-3">
        <div style="position: relative">
            <div class="banner-academy"></div>
            <div class="d-flex justify-content-center align-items-center banner-content">
                <div class="col-12 col-md-8 col-lg-8 col-xl-10 title-text-compe poppins-bold text-white text-center">Latih
                    Kemampuanmu Sejak Dini</div>
            </div>
        </div>

        <div class="d-flex flex-wrap row-gap-4 my-5">
            {{-- list pelatih --}}
            @forelse ($academy as $item)
                <a href="{{ url('info-akademi/detail/' . $item->slug) }}"
                    class="col-12 col-md-12 col-lg-6 px-2 text-decoration-none">
                    <div class="bg-white compe-card border rounded-4">
                        {{-- nama pelatih --}}
                        <div class="col">
                            <div class="d-flex column-gap-4">
                                <div style="width: 70px; height: 70px">
                                    <img src="{{ asset('assets/dist/img/akademi/coach.png') }}" class="img-fluid rounded-circle"
                                        alt="">
                                </div>
                                <div class="d-flex flex-column row-gap-2">
                                    <div class="col text-color-secondary text-uppercase">Pelatih</div>
                                    <div class="col poppins-bold text-color-primary text-capitalize text-compe-title">{{ $item->coach_name }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- info latihan --}}
                        <div class="col text-color-secondary mt-4">
                            {{-- flex wrapper --}}
                            <div class="d-flex flex-sm-column flex-md-row flex-wrap gap-3 mb-3">
                                {{-- list --}}
                                <div class="d-flex flex-column flex-wrap gap-3">
                                    <div class="d-flex flex-row column-gap-3">
                                        <div style="width: 24px; height: 24px">
                                            <img src="{{ asset('assets/dist/icon/date.png') }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="poppins-medium text-color-secondary text-compe-info">{{ $item->day_schedule }}</div>
                                    </div>
    
                                    <div class="d-flex flex-row column-gap-3">
                                        <div style="width: 24px; height: 24px">
                                            <img src="{{ asset('assets/dist/icon/price.png') }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="poppins-medium text-color-secondary text-compe-info">Rp {{ number_format($item->price_academy, 0, ",", ".") }}/bulan</div>
                                    </div>
                                </div>

                                <div class="d-flex flex-column flex-wrap gap-3">
                                    <div class="d-flex flex-row column-gap-3">
                                        <div style="width: 24px; height: 24px">
                                            <img src="{{ asset('assets/dist/icon/pertemuan.png') }}" class="img-fluid"
                                                alt="">
                                        </div>
                                        <div class="poppins-medium text-color-secondary text-compe-info">{{ $item->meeting }} pertemuan</div>
                                    </div>
    
                                    <div class="d-flex flex-row column-gap-3">
                                        <div style="width: 24px; height: 24px">
                                            <img src="{{ asset('assets/dist/icon/time.png') }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="poppins-medium text-color-secondary text-compe-info">{{ $item->time_schedule_start }} - {{ $item->time_schedule_end }} WIB</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="poppins-semibold fs-4">Belum ada informasi perlombaan</div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
@endpush
