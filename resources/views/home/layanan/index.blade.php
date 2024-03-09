<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="{{ asset('js/search.js') }}"></script> --}}
    <link rel="stylesheet" href="{{ url('css/layanan/index.css') }}">

    <style>
        /* CSS untuk dropdown */
        #search-dropdown {
            position: relative;
            background-color: #fff;
            max-height: auto;
            overflow-y: auto;
            width: 20%;
            top: 80%;
        }
        #search-dropdown img {
        max-width: 2000px; /* Sesuaikan ukuran gambar sesuai kebutuhan */
        max-height: 200px;
        margin-right: auto; /* Sesuaikan margin sesuai kebutuhan */
    }
        .dropdown-item {
            padding: 8px 12px;
            color: #333;
            text-decoration: none;
            display: block;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }


    </style>

<script>
function displaySearchResults(data) {
    var results = data.data || [];
    var query = $('#search-query').val().toLowerCase();

    // Hanya tampilkan dropdown jika query tidak kosong dan ada hasil pencarian
    if (query.length > 0 && results.length > 0) {
        var dropdown = '<ul>';
        results.forEach(function (result) {
            var namaPesananLowerCase = result.nama_pesanan.toLowerCase();

            if (namaPesananLowerCase.includes(query)) {
                dropdown += '<li><a href="#" onclick="selectResult(\'' + result.nama_pesanan + '\')">';

                // Ambil gambar dari hasil pencarian
                if (result.gambar_pesanan && result.gambar_pesanan.length > 0) {
                    var imageUrl = '{{ asset("storage/") }}' + '/' + JSON.parse(result.gambar_pesanan)[0];
                    dropdown += '<img src="' + imageUrl + '" alt="Gambar Pesanan">';
                }

                dropdown += result.nama_pesanan + '</a></li>';
            }
        });
        dropdown += '</ul>';

        $('#search-dropdown').html(dropdown);
    } else {
        $('#search-dropdown').html('');
    }
}




    function selectResult(name) {
        $('#search-query').val(name);
        $('#search-dropdown').html('');
    }

    function search() {
        var query = $('#search-query').val();

        if (query.length >= 1) {
            $.ajax({
                type: 'GET',
                url: '/search',
                data: { query: query },
                success: function (data) {
                    displaySearchResults(data);
                }
            });
        }
    }
</script>
    <title>Semua Layanan</title>
</head>

@include('components.navbar')

<body>
    <section>
        <div>
            <h1>Halaman Layanan</h1>
        </div>

        <div id="search-results">
            <form id="search-form" action="{{ route('carilayanan') }}" method="get">
                @csrf
                <input class="form-control mr-sm-2" id="search-query" type="text" name="query" onkeyup="search()">
            </form>
            <div id="search-dropdown">
                <!-- Search results dropdown will be populated here -->
            </div>
        </div>
    </section>

    <section class="card-container">
        <!-- Loop untuk 8 pesanan berbayar -->
        @php $count = 0; @endphp
        @foreach ($pesanans as $pesanan)
            @if($pesanan->publish == 'publish' && $pesanan->status == 'berbayar')
                @php $count++; @endphp
                @if($count <= 8) <!-- Hanya tampilkan 8 pesanan berbayar -->
                    <div class="card">
                        <!-- Konten kartu -->
                        <h1 class="card-text">{{ $pesanan->nama_pesanan }}</h1>
                        <p class="card-text">
                            Lokasi Provinsi: {{ $pesanan->lokasi_provinsi }}
                        </p>
                        <p class="card-text">
                            Vendor:
                            @if ($pesanan->vendor)
                                <a href="{{ route('company', ['id' => $pesanan->vendor->id]) }}" class="vendor-link">
                                    {{ $pesanan->vendor->vendor }}
                                </a>
                            @else
                                Tidak ada vendor
                            @endif
                        </p>

                        <p class="card-text">
                            Lokasi kota: {{ $pesanan->lokasi_kota }}
                        </p>
                        <!-- Tampilkan gambar pertama -->
                        @if ($pesanan->gambar_pesanan)
                            <div class="card-img-top">
                                @php
                                    $firstImage = json_decode($pesanan->gambar_pesanan)[0];
                                @endphp
                                <img src="{{ asset('storage/' . $firstImage) }}" alt="Gambar Pesanan">
                            </div>
                        @endif
                        <!-- Tombol-tombol -->
                        <div class="card-buttons">
                            @if($pesanan->vendor)
                                <button onclick="window.location.href='https://wa.me/{{ $pesanan->vendor->nohp }}'">Pesan</button>
                            @else
                                <p>Tidak ada vendor.</p>
                            @endif
                            <button onclick="window.location.href='{{ route('vendordetail', ['nama_pesanan_id' => $pesanan->nama_pesanan . '_id_' . $pesanan->id]) }}'">Lihat Detail</button>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach

        <!-- Loop untuk 2 pesanan gratis -->
        @foreach ($pesanans as $pesanan)
            @if($pesanan->publish == 'publish' && $pesanan->status == 'free')
                <div class="card">
                    <!-- Konten kartu -->
                    <h1 class="card-text">{{ $pesanan->nama_pesanan }}</h1>
                    <p class="card-text">
                        Lokasi Provinsi: {{ $pesanan->lokasi_provinsi }}
                    </p>
                    <p class="card-text">
                        Vendor:
                        @if ($pesanan->vendor)
                        <a href="{{ route('company', ['id' => $pesanan->vendor->id]) }}" style="cursor: pointer; color: black; text-decoration: none;">
                            {{ $pesanan->vendor->vendor }}
                        </a>

                        @else
                            Tidak ada vendor
                        @endif
                    </p>
                    <p class="card-text">
                        Lokasi kota: {{ $pesanan->lokasi_kota }}
                    </p>
                    <!-- Tampilkan gambar pertama -->
                    @if ($pesanan->gambar_pesanan)
                        <div class="card-img-top">
                            @php
                                $firstImage = json_decode($pesanan->gambar_pesanan)[0];
                            @endphp
                            <img src="{{ asset('storage/' . $firstImage) }}" alt="Gambar Pesanan">
                        </div>
                    @endif
                    <!-- Tombol-tombol -->
                    <div class="card-buttons">
                        @if($pesanan->vendor)
                            <button onclick="window.location.href='https://wa.me/{{ $pesanan->vendor->nohp }}'">Pesan</button>
                        @else
                            <p>Tidak ada vendor.</p>
                        @endif
                        <button onclick="window.location.href='{{ route('vendordetail', ['nama_pesanan_id' => $pesanan->nama_pesanan . '_id_' . $pesanan->id]) }}'">Lihat Detail</button>
                    </div>
                </div>
            @endif
        @endforeach
    </section>




    <!-- Tambahkan baris berikut untuk menampilkan pagination -->
    <div>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($pesanans->currentPage() == 1)
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $pesanans->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($pesanans->hasMorePages())
                <li>
                    <a href="{{ $pesanans->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    </div>

</body>

</html>
