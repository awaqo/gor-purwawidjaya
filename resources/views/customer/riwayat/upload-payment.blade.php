@extends('layout.app')

@section('title', 'Upload Pembayaran')

@section('content')
    <div class="container min-vh-100" style="margin-top: 130px">
        <div>upload pembayaran</div>
        <hr>
        <div>Ringkasan</div>
        @foreach ($transaction as $item)
            <div>Biaya Booking : Rp {{ number_format($item->total - $item->unique_payment_code, 0, ',', '.') }}</div>
            <div>Kode Unik : {{ number_format($item->unique_payment_code, 0, ',', '.') }}</div>
            <div>Grand Total : Rp {{ number_format($item->total, 0, ',', '.') }}</div>
        @endforeach
        <hr>
        <form action="/riwayat-pesanan/upload-pembayaran/{{ $transactionID }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col mb-3">
                <label for="pay_amount" class="form-label">Nominal Transfer</label>
                <input type="number" class="form-control" name="pay_amount" id="pay_amount" required>
                <div id="pay_message"></div>
            </div>

            <div class="col mb-3">
                <label for="buktiPembayaran" class="form-label">Bukti Transfer</label>
                <input type="file" class="form-control" name="buktiPembayaran" id="buktiPembayaran"
                    onchange="previewImage()" required>

                <div>
                    @if (isset($item) && $item->image)
                        <img id="image-preview" src="{{ Storage::url($item->image) }}">
                    @else
                        <img id="image-preview">
                    @endif
                </div>
            </div>

            <button type="submit" id="kirim-bukti" class="btn btn-primary">Kirim</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        var data = {!! json_encode($transaction) !!};
        const amount = document.querySelector("#pay_amount");
        const message = document.querySelector("#pay_message");

        $(document).ready(() => {
            console.log(data[0].total);
        });

        $('#pay_amount').on("change", function() {
            if (amount.value != data[0].total) {
                console.log("belum sama");
                amount.classList.remove("is-valid");
                amount.classList.add("is-invalid");
                message.classList.add("invalid-feedback");
                message.innerHTML = "Pastikan input sesuai grand total";
                message.style.display = "inline";
            } else {
                amount.classList.remove("is-invalid");
                amount.classList.add("is-valid");
                message.style.display = "none";
                console.log("sama");
            }
            console.log(amount.value);
        });

        function previewImage() {
            var preview = document.getElementById('image-preview');
            var file = document.querySelector('input[type=file]').files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                var tempImg = new Image();
                tempImg.src = reader.result;

                tempImg.onload = function() {
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');

                    canvas.width = 160;
                    canvas.height = 150;

                    ctx.drawImage(tempImg, 0, 0, 160, 150);

                    preview.src = canvas.toDataURL('image/jpeg', 1.0);
                }
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
