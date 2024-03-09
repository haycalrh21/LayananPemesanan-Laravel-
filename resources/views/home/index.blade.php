<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/home/index.css') }}">

    <style>

    </style>
    <title>Home</title>
    @include('components.navbar')

</head>

<body>
    <section>
        <!-- Navbar Section -->
    </section>

    <section>
        <!-- Search Section -->


        <!-- Greeting Section -->
        @guest
            <div style="text-align: center;">
                <h1>Halo Everyone!!</h1>
            </div>
        @endguest
        @auth
            <div style="text-align: center;">
                <h1>Selamat datang {{ auth()->user()->name }}!</h1>
            </div>

        @endauth


    </section>
    <section>
        <!-- Bootstrap Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @php
                    $active = 'active';
                @endphp
                @foreach ($pesanans as $index => $pesanan)
                    @if ($pesanan->status === 'berbayar')
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                            class="{{ $active }}"></li>
                        @php
                            $active = '';
                        @endphp
                    @endif
                @endforeach
            </ol>

            <div class="carousel-inner">
                @php
                    $active = 'active';
                @endphp
                @foreach ($pesanans as $pesanan)
                    @if ($pesanan->status === 'berbayar')
                        <div class="carousel-item {{ $active }}">

                            @if ($pesanan->gambar_pesanan)
                                @php
                                    $gambarPath = json_decode($pesanan->gambar_pesanan)[0];
                                @endphp
                                <img class="d-block w-100" src="{{ asset('storage/' . $gambarPath) }}"
                                    alt="Gambar Pesanan">
                            @endif
                        </div>
                        @php
                            $active = '';
                        @endphp
                    @endif
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>



    </section>

    <!-- Card Section -->
    <section style="text-align: center;">
        <div>
            <h1>Apa yang anda cari ?</h1>
        </div>

        <div class="card-container">
            @foreach (['Udara', 'Darat', 'Laut'] as $jenis_pesanan)
                <div class="card">
                    <h1>{{ $jenis_pesanan }} ?</h1>
                    @if ($jenis_pesanan == 'Udara')
                        <img src="{{ asset('gambar/plane.png') }}" alt="{{ $jenis_pesanan }} Image">
                    @elseif($jenis_pesanan == 'Darat')
                        <img src="{{ asset('gambar/truck.png') }}" alt="{{ $jenis_pesanan }} Image">
                    @elseif($jenis_pesanan == 'Laut')
                        <img src="{{ asset('gambar/ferry.png') }}" alt="{{ $jenis_pesanan }} Image">
                    @endif
                    <button
                        onclick="window.location='{{ route('layananaja', ['jenis_pesanan' => strtolower($jenis_pesanan)]) }}'">Lihat
                        Disini</button>
                </div>
            @endforeach

            <div class="card">
                <h1>semua layanan</h1>
                <img src="{{ asset('gambar/ferry.png') }}" alt="Ferry Image">
                <button onclick="window.location='{{ route('semualayanan') }}'">Lihat Disini</button>
            </div>
        </div>
        <!-- Carousel Section -->

    </section>
    <section>
        <h1>
            <center>
                kenapa memilih iklan disini ?
            </center>
        </h1>
        <div>
            <form action="{{ route('carilayanan') }}" method="get">
                <center>
                    <input type="text" name="keyword" placeholder="cari kata pencarian">
                    <button type="submi">cari </button>
                </center>
            </form>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.querySelector('.carousel-track');
            const items = document.querySelectorAll('.carousel-item');
            const totalItems = items.length;
            let currentIndex = 0;

            function nextSlide() {
                if (currentIndex < totalItems - 1) {
                    currentIndex++;
                } else {
                    currentIndex = 0;
                }
                updateCarousel();
            }

            function prevSlide() {
                if (currentIndex > 0) {
                    currentIndex--;
                } else {
                    currentIndex = totalItems - 1;
                }
                updateCarousel();
            }

            function updateCarousel() {
                const newTransformValue = -currentIndex * 100 + '%';
                track.style.transform = 'translateX(' + newTransformValue + ')';
            }

            document.querySelector('.carousel-button-next').addEventListener('click', nextSlide);
            document.querySelector('.carousel-button-prev').addEventListener('click', prevSlide);
        });
    </script>


</body>

</html>
