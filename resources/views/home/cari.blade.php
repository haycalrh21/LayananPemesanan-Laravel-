<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@include('components.navbar')
<body>
    <h1>Hasil Pencarian Pesanan</h1>

<!-- Di dalam tampilan Blade (home.cari) -->
@if(count($pesanans) > 0)
    <!-- Tampilkan hasil pencarian -->
    @foreach($pesanans as $pesanan)
        <div class="card">
            <h1 class="card-text"> {{ $pesanan->nama_pesanan }}</h1>
            <p class="card-text">Jenis Layanan: {{ $pesanan->jenis_pesanan }}</p>
            <p class="card-text">Jenis Detail Layanan: {{ $pesanan->jenis_detail }}</p>
            <p class="card-text">Lokasi Provinsi: {{ $pesanan->lokasi_provinsi }}</p>
            <p class="card-text">Lokasi Kota: {{ $pesanan->lokasi_kota }}</p>
        </div>
    @endforeach
@else
    <!-- Tampilkan pesan jika tidak ada hasil pencarian -->
    <p>Tidak ditemukan pesanan dengan kata kunci '{{ $keyword }}'</p>
@endif


</body>
</html>
