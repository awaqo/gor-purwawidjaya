@extends('layout.app')

@section('title', 'Upload Pembayaran')

@section('content')
    <div>upload pembayaran</div>
    <hr>
    <div>Ringkasan</div>
    @foreach ($data as $item)
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
        </div>

        <div class="col mb-3">
            <label for="buktiPembayaran" class="form-label">Bukti Transfer</label>
            <input type="file" class="form-control" name="buktiPembayaran" id="buktiPembayaran" onchange="previewImage()"
                required>

            <div>
                @if (isset($item) && $item->image)
                    <img id="image-preview" src="{{ Storage::url($item->image) }}">
                @else
                    <img id="image-preview">
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
@endsection

@push('scripts')
    <script>
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
