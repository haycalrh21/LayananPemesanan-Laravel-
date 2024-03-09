<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <title>Vendor Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;

            background-color: #1a0909;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: auto 150px auto; /* Menggunakan "auto" untuk mengatur tinggi sejalan dengan konten */
            gap: 20px; /* Memberikan jarak antar elemen */
            justify-items: center; /* Meletakkan elemen di tengah kolom */
            align-items: center; /* Meletakkan elemen di tengah baris */
            padding: 20px;
        }

        .section {
            width: 100%;
            box-shadow: 0 5px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            color: #1a0909;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        gap: 20px;
        padding: 20px;
    }

    .card {
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        width: calc(30% - 25px); /* 20% width for each card with 20px gap in between */
        box-sizing: border-box;
    }

    .logo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-top: -50px;
        margin-bottom: 20px;
    }

    .banner {
        width: 100%;
        height: 300px;
        border-radius: 8px;
        background-size: cover;
        background-position: center;
    }

    @media (max-width: 768px) {
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            width: calc(100% - 25px); /* Set lebar kartu menjadi 100% pada tampilan mobile */
            margin-bottom: 20px;
        }

        .carousel {
            max-width: 100%; /* Set lebar maksimum carousel menjadi 100% pada tampilan mobile */
        }
        .section {
                grid-template-columns: 1fr; /* Merubah kolom saat layar kecil */
            }
    }

        @media (min-width: 767px) and (max-width: 1043px) {
            .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            width: calc(50% - 25px); /* Set lebar kartu menjadi 100% pada tampilan mobile */
            margin-bottom: 20px;
        }

        .carousel {
            max-width: 100%; /* Set lebar maksimum carousel menjadi 100% pada tampilan mobile */
        }
        .section {
                grid-template-columns: 1fr; /* Merubah kolom saat layar kecil */
            }
        }
    </style>

</head>

@include('components.navbar')
<body>
    <div class="container">
        <section class="section">
            <!-- Center Section (Banner) -->
            <div class="banner" style="background-image: url('{{ asset("storage/$folderPath/gambar_banner.jpg") }}');"></div>
        </section>

        <section class="section">
            <!-- Left Section (Logo) -->
            <div>
                <img src="{{ asset("storage/$folderPath/gambar_logo.jpg") }}" alt="Logo" class="logo">
                <h1>
                    {{ $vendor->vendor }}
                </h1>
            </div>
        </section>

        <section class="section">
            <!-- Right Section -->

            <p>Email: {{ $vendor->email }}</p>
            <p>No HP: {{ $vendor->nohp }}</p>
            <p>Alamat: {{ $vendor->alamat }}</p>

        </section>

        <section class="card-container">
            @foreach ($pesanans as $pesanan)
                <div class="card">
                    <h1 class="card-text"> {{ $pesanan->nama_pesanan }}</h1>
                    <p class="card-text">Jenis Layanan: {{ $pesanan->jenis_pesanan }}</p>
                    <p class="card-text">Jenis Detail Layanan: {{ $pesanan->jenis_detail }}</p>
                    <p class="card-text">Lokasi Provinsi: {{ $pesanan->lokasi_provinsi }}</p>
                    <p class="card-text">Lokasi Kota: {{ $pesanan->lokasi_kota }}</p>

                    <div id="carouselExample{{ $pesanan->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @php
                                $gambarPesanan = json_decode($pesanan->gambar_pesanan);
                            @endphp
                            @foreach ($gambarPesanan as $index => $gambar)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $gambar) }}" class="d-block w-100" alt="Gambar Pesanan">
                                </div>
                            @endforeach
                        </div>

                        @if(Auth::check() && Auth::user()->role === 'vendor' && Auth::user()->id === $pesanan->user_id)
                        <form action="{{ $pesanan->publish === 'publish' ? route('sembunyikan', ['id' => $pesanan->id]) : route('tampilkan', ['id' => $pesanan->id]) }}" method="post" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" onclick="return confirm('{{ $pesanan->publish === 'publish' ? 'Apakah Anda yakin ingin menyembunyikan iklan ini?' : 'Apakah Anda yakin ingin menampilkan iklan ini?' }}')">
                                {{ $pesanan->publish === 'publish' ? 'Sembunyikan Iklan' : 'Tampilkan Iklan' }}
                            </button>
                        </form>
                    @endif


                    @if(Auth::check() && Auth::user()->role === 'vendor' && Auth::user()->id === $pesanan->user_id)
    <form action="{{ route('deleteiklan', ['id' => $pesanan->id]) }}" method="post" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus iklan ini?')">
            Hapus Iklan
        </button>
    </form>
@endif
@if($pesanan->vendor)
<button onclick="window.location.href='https://wa.me/{{ $pesanan->vendor->nohp }}'">Pesan</button>
@else
<p>Tidak ada vendor.</p>
@endif
<button onclick="window.location.href='{{ route('vendordetail', ['nama_pesanan_id' => $pesanan->nama_pesanan . '_id_' . $pesanan->id]) }}'">Lihat Detail</button>

                    </div>
                </div>
            @endforeach
        </section>

    </div>
</body>

</html>
