@extends('layout.app')

@section('title', 'Detail Perlombaan')

@section('content')
    <div class="container container-detail-compe min-vh-100 px-4">
        <a href="{{ route('info-lomba') }}" class="text-decoration-none text-color-secondary poppins-semibold">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>

        <div class="d-flex flex-column row-gap-3 mt-4">
            {{-- nama lomba --}}
            <div class="col">
                <div class="d-flex column-gap-4">
                    <div style="width: 70px; height: 70px">
                        <img src="{{ asset('assets/dist/img/lomba/trofi.png') }}" class="img-fluid rounded-circle"
                            alt="">
                    </div>
                    <div class="d-flex flex-column row-gap-2">
                        <div class="col poppins-bold text-color-primary text-capitalize text-compe-title">
                            {{ $detail_compe->title }}</div>
                        <div class="col poppins-semibold text-color-secondary text-capitalize">Tournament</div>
                    </div>
                </div>
            </div>

            <div class="text-success">
                <hr>
            </div>

            {{-- deskripsi pertandingan --}}
            <div class="col">
                <div class="poppins-bold text-color-primary fs-5">
                    Deskripsi Pertandingan
                </div>
                <div class="poppins-regular text-color-secondary fs-6">{{ $detail_compe->description }}</div>
            </div>

            <div class="text-color-secondary">
                <hr>
            </div>

            {{-- info lomba --}}
            <div class="col text-color-secondary">
                <div class="poppins-bold text-color-primary fs-5">
                    Ketentuan Pertandingan
                </div>

                {{-- flex wrapper --}}
                <div class="d-flex flex-sm-column flex-md-row flex-wrap my-3 gap-4">
                    {{-- list --}}
                    <div class="d-flex flex-column flex-wrap gap-3">
                        <div class="d-flex flex-row column-gap-3">
                            <div style="width: 24px; height: 24px">
                                <img src="{{ asset('assets/dist/icon/date.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="poppins-medium text-color-secondary text-compe-info">
                                {{ date('d F Y', strtotime($detail_compe->date_start)) }}</div>
                        </div>

                        <div class="d-flex flex-row column-gap-3">
                            <div style="width: 24px; height: 24px">
                                <img src="{{ asset('assets/dist/icon/person.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="poppins-medium text-color-secondary text-compe-info">{{ $detail_compe->slot_competition }} Slot</div>
                        </div>
                    </div>
                    {{-- list --}}
                    <div class="d-flex flex-column flex-wrap gap-3">
                        <div class="d-flex flex-row column-gap-3">
                            <div style="width: 24px; height: 24px">
                                <img src="{{ asset('assets/dist/icon/price.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="poppins-medium text-color-secondary text-compe-info">Rp {{ number_format($detail_compe->price_competition, 0, ",", ".") }}/slot</div>
                        </div>

                        <div class="d-flex flex-row column-gap-3">
                            <div style="width: 24px; height: 24px">
                                <img src="{{ asset('assets/dist/icon/person.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="poppins-medium text-color-secondary text-compe-info">{{ $detail_compe->category_competition }}</div>
                        </div>
                    </div>
                    {{-- list --}}
                    <div class="d-flex flex-column flex-wrap gap-3">
                        <div class="d-flex flex-row column-gap-3">
                            <div style="width: 24px; height: 24px">
                                <img src="{{ asset('assets/dist/icon/difficult.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="poppins-medium text-color-secondary text-compe-info">{{ $detail_compe->difficulty_competition }}</div>
                        </div>

                        <div class="d-flex flex-row column-gap-3">
                            <div style="width: 24px; height: 24px">
                                <img src="{{ asset('assets/dist/icon/location.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="poppins-medium text-color-secondary text-compe-info">{{ $detail_compe->location_competition }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <!-- Button trigger modal -->
                <button type="button" class="join-now poppins-semibold text-center text-decoration-none px-4 py-3 rounded-5" data-bs-toggle="modal" data-bs-target="#joinCompe">
                    Hubungi Sekarang
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="joinCompe" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="joinCompeLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5">
                        <div class="d-flex flex-column align-items-center row-gap-4">
                            <div class="col-12 col-md-12 col-lg-8">
                                <div class="poppins-semibold text-color-primary text-center fs-5">
                                    Silahkan hubungi no WhatsApp dibawah ini untuk informasi lebih lanjut
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-8">
                                <div class="d-flex align-items-center justify-content-center column-gap-3">
                                    <div style="width: 36px; height: 36px">
                                        <img src="{{ asset('assets/dist/icon/whatsapp-colored.png') }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="poppins-medium text-color-secondary">
                                        085636212322 - Andri Prayoga
                                    </div>
                                </div>
                            </div>

                            <div class="col mt-4 mb-5">
                                <a href="https://wa.link/bz5jcv" target="_blank" class="btn-join-academy px-5 py-3 mt-lg-4 rounded-5 poppins-semibold">WhatsApp</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
