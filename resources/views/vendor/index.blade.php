<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }



    h2 {
        color: #070707;
        text-align: left;
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
        margin-bottom: 20px;
        border: 1px solid #ddd;
        width: 275px;
        box-sizing: border-box;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        margin-bottom: 10px;
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
        max-height: 300px;
        /* Ubah tinggi maksimum sesuai kebutuhan Anda */
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .card {
            flex: 0 0 calc(50% - 20px);
        }
    }

    @media (max-width: 576px) {
        .card {
            flex: 0 0 100%;
        }
    }
</style>

<body>
    <section>
        @include('components.navbar')
    </section>
    <section>
    </section>
    <h1>halaman Vendor</h1>

    @php
    $userId = auth()->id();
    @endphp

    <section class="card-container">
        @foreach ($pesanans as $pesanan)
        @if ($pesanan->user_id === $userId)
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

                <form action="{{ $pesanan->publish === 'publish' ? route('sembunyikan', ['id' => $pesanan->id]) : route('tampilkan', ['id' => $pesanan->id]) }}" method="post" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" onclick="return confirm('{{ $pesanan->publish === 'publish' ? 'Apakah Anda yakin ingin menyembunyikan iklan ini?' : 'Apakah Anda yakin ingin menampilkan iklan ini?' }}')">
                        {{ $pesanan->publish === 'publish' ? 'Sembunyikan Iklan' : 'Tampilkan Iklan' }}
                    </button>
                </form>
                <form action="{{ route('deleteiklan', ['id' => $pesanan->id]) }}" method="post" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus iklan ini?')">
                        Hapus Iklan
                    </button>
                </form>







            </div>


        </div>
        @endif
        @endforeach
    </section>
</body>
<script>
    let slideIndex = 0;

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("carousel-item");

        if (n >= slides.length) {
            slideIndex = 0;
        }

        if (n < 0) {
            slideIndex = slides.length - 1;
        }

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex].style.display = "block";
    }





</script>



</html>
