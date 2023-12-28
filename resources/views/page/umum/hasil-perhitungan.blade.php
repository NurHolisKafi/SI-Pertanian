<div class="container pl-5 pt-3">
    <div class="row">
        @foreach ($result as $item)
        <div class="col-6">
            <label class="text-gray-600">{{ $item['nama'] }} x {{ $item['jumlah'] }}</label>
        </div>
        <div class="col-6">
            <p>&#177; Rp {{ $item['harga'] }}</p>
        </div>
        @endforeach
        <div class="col-6">
            <label class="text-gray-600">Total Keseluruhan</label>
        </div>
        <div class="col-6">
            <p>Rp {{ $hargaTotal }}</p>
        </div>
        <div class="col-6">
            <label class="text-gray-600">Sisa Modal</label>
        </div>
        <div class="col-6">
            <p>Rp {{ $sisaModal }}</p>
        </div>
        <div class="col">
            <small class="text-warning">Catatan:
                <ul>
                    <li>harga kebutuhan tanaman dapat berbeda setiap daerah</li>
                    <li>jika terdapat nama bahan yang sama, pilih salah satu.</li>
                    <li>jumlah berdasarkan per kg/satuan</li>
                </ul>
            </small>
        </div>
    </div>
</div>