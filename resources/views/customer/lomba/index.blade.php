@extends('layout.app')

@section('title', 'Informasi Perlombaan')

@section('content')
    <div class="container container-competition min-vh-100 px-3">
        <div style="position: relative">
            <div class="banner-competition"></div>
            <div class="d-flex justify-content-center align-items-center banner-content">
                <div class="col-12 col-md-8 col-lg-8 col-xl-10 title-text-compe poppins-bold text-white text-center">Raihlah juara di setiap
                    pertandingan</div>
            </div>
        </div>

        <div class="d-flex flex-wrap row-gap-4 mt-5">
            @forelse ($compe as $item)
                <a href="{{ url('info-perlombaan/detail/' . $item->slug) }}" class="col-12 col-md-12 col-lg-6 px-2 text-decoration-none">
                    <div class="bg-white compe-card border rounded-4">
                        {{-- nama lomba --}}
                        <div class="col">
                            <div class="d-flex column-gap-4">
                                <div style="width: 70px; height: 70px">
                                    <img src="{{ asset('assets/dist/img/lomba/trofi.png') }}"
                                        class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="d-flex flex-column row-gap-2">
                                    <div class="col poppins-semibold text-color-secondary text-uppercase">Tournament</div>
                                    <div class="col poppins-bold text-color-primary text-capitalize text-compe-title">{{ $item->title }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- info lomba --}}
                        <div class="col text-color-secondary mt-4">
                            {{-- flex wrapper --}}
                            <div class="d-flex flex-sm-column flex-md-row flex-wrap gap-3 mb-3">
                                {{-- list --}}
                                <div class="d-flex flex-column flex-wrap gap-3">
                                    <div class="d-flex flex-row column-gap-3">
                                        <div style="width: 24px; height: 24px">
                                            <img src="{{ asset('assets/dist/icon/date.png') }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="poppins-medium text-color-secondary text-compe-info">{{ date('d F Y', strtotime($item->date_start)) }}</div>
                                    </div>
    
                                    <div class="d-flex flex-row column-gap-3">
                                        <div style="width: 24px; height: 24px">
                                            <img src="{{ asset('assets/dist/icon/person.png') }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="poppins-medium text-color-secondary text-compe-info">{{ $item->slot_competition }} Slot</div>
                                    </div>
                                </div>

                                <div class="d-flex flex-column flex-wrap gap-3">
                                    <div class="d-flex flex-row column-gap-3">
                                        <div style="width: 24px; height: 24px">
                                            <img src="{{ asset('assets/dist/icon/price.png') }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="poppins-medium text-color-secondary text-compe-info">Rp {{ number_format($item->price_competition, 0, ",", ".") }}/slot</div>
                                    </div>
    
                                    <div class="d-flex flex-row column-gap-3">
                                        <div style="width: 24px; height: 24px">
                                            <img src="{{ asset('assets/dist/icon/person.png') }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="poppins-medium text-color-secondary text-compe-info">{{ $item->category_competition }}</div>
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
