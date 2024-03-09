<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Semua Layanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            padding: 20px;
        }

        .card {
            flex: 0 0 calc(33.33% - 20px);
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            color: #000000;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            width: 275px;
            box-sizing: border-box;
            position: relative; /* Tambahkan properti position relative */
        }

        ul {
            list-style: none;
            padding: 0;
        }

        p {
            color: #000000;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .card-img-top {
            overflow: hidden;
        }

        /* Kecilkan semua gambar */
        .card img {
    width: 100%;
    max-height: 200px;
    object-fit: fill;
    border-radius: 8px;
    margin-bottom: 30px;
}



        .card-buttons {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: space-around;
            width: 80%;
            max-width: 200px;
        }

        button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 5px 10px; /* Ubah padding untuk memberi ruang di sekitar teks tombol */
    border-radius: 8px; /* Atur nilai border-radius sesuai keinginan Anda */
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}


        @media (max-width: 768px) {
            .card {
                flex: 0 0 calc(50% - 20px);
            }

        button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 5px 10px; /* Ubah padding untuk memberi ruang di sekitar teks tombol */
    border-radius: 8px; /* Atur nilai border-radius sesuai keinginan Anda */
    cursor: pointer;
}
        }

        @media (max-width: 576px) {
            .card {
                flex: 0 0 100%;
            }

            .card-buttons {
                width: 100%; /* Lebarkan tombol ke seluruh lebar kartu pada layar kecil */
            }

        button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 5px 10px; /* Ubah padding untuk memberi ruang di sekitar teks tombol */
    border-radius: 8px; /* Atur nilai border-radius sesuai keinginan Anda */
    cursor: pointer;
}
        }
    </style>
</head>
@include('components.navbar')
<body>





    <section>
        <section class="card-container">
            <!-- Loop untuk setiap pesanan -->
            @if(count($pesanan) > 0)
            @foreach ($pesanan as $order)
            <div class="card">
                <h1 class="card-text">{{ $order->nama_pesanan }}</h1>

                <p class="card-text">Jenis Layanan: {{ $order->jenis_pesanan }}</p>
                <p class="card-text">Jenis Detail Layanan: {{ $order->jenis_detail }}</p>
                <p class="card-text">Lokasi Provinsi: {{ $order->lokasi_provinsi }}</p>
                <p class="card-text">Lokasi Kota: {{ $order->lokasi_kota }}</p>

                <!-- Tampilkan gambar pertama -->
                @if ($order->gambar_pesanan)
                <div class="card-img-top">
                    @php
                    $firstImage = json_decode($order->gambar_pesanan)[0];
                    @endphp
                    <img src="{{ asset('storage/' . $firstImage) }}" alt="Gambar Pesanan">
                </div>
                @endif

                <!-- Tombol-tombol -->
                <div class="card-buttons">
                    <!-- Tombol pesan -->
                    @if($vendors->count() > 0)
                    <button onclick="window.location.href='https://wa.me/{{ $vendors[0]->nohp }}'">Pesan</button>
                    @else
                    <p>Tidak ada vendor.</p>
                    @endif

                    <!-- Tombol lihat detail -->
                    {{-- <button onclick="window.location.href='{{ route('vendordetail', ['nama_pesanan_id' => $pesanan->nama_pesanan . '_id_' . $pesanan->id]) }}'">Lihat Detail</button> --}}

                </div>
            </div>
            @endforeach
            @endif
        </section>
    </section>
</body>
</html>
