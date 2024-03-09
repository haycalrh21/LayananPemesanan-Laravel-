<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Vendor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <style>body {
        font-family: Arial, sans-serif;


    }

    .container {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        max-width:  100%;
    }

    .wrapper {
        display: flex;
    }

    .right-section,
    .left-section {


        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        color: #1a0909;
        border: 1px solid #ddd;
        box-sizing: border-box;
        margin: 10px;
    }

    /* CSS untuk gambar responsif */
    .img-responsive {
        display: block;
        width: 100%;
        height: auto;
        border-radius: 8px; /* Tambahkan border-radius agar gambar memiliki sudut melengkung */
    }

    h1 {
        color: #333;
        text-align: left;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    button:hover {
        background-color: #0056b3;
    }

    @media (min-width: 992px) {
        .left-section,
        .right-section {
            width: 48%; /* Sesuaikan nilai lebar sesuai kebutuhan */
        }
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column; /* Tampilkan elemen secara bertumpuk pada layar kecil */
        }

        .left-section,
        .right-section {
            width: 100%; /* Gunakan lebar penuh pada layar kecil */
        }
    }

    </style>
</head>

@include('components.navbar')

<body>
    <div class="container">

        <!-- Left Section with Image -->
        <div class="left-section">
            @if ($pesanan->gambar_pesanan)
            @php
            $firstImage = json_decode($pesanan->gambar_pesanan)[0];
            @endphp
            <img src="{{ asset('storage/' . $firstImage) }}" alt="Gambar Pesanan"
                class="img-responsive">
            @endif
        </div>

        <!-- Right Section with Vendor Details -->
        <div class="right-section">
            <h1>Detail Vendor</h1>
            <div>
                <p>Jenis Layanan: {{ $pesanan->jenis_pesanan }}</p>
                <p>Jenis Detail Layanan: {{ $pesanan->jenis_detail }}</p>
                <p>Nama Layanan: {{ $pesanan->nama_pesanan }}</p>
                <p>Lokasi Provinsi: {{ $pesanan->lokasi_provinsi }}</p>
                <p>Lokasi Kota: {{ $pesanan->lokasi_kota }}</p>
                <p>Deskripsi :{{ $pesanan->deskripsi }}</p>
            </div>

            <!-- Button for WhatsApp -->
            @if ($pesanan->vendors && $pesanan->vendors->count() > 0)
            <button
                onclick="window.location.href='https://wa.me/{{ $pesanan->vendors->first()->nohp }}'">
                Pesan
            </button>
            @endif

            <!-- Button to go back to Layanan -->
            <button
                onclick="window.location.href='{{ route('semualayanan') }}'">
                Kembali ke Layanan
            </button>
        </div>

    </div>
</body>

</html>
