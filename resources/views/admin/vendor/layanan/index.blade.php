<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data layanan</title>
</head>

<style>
    .table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    .table, th, td {
        border: 1px solid #050505;
    }

    th, td {
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #100f0f;
        color: white;
        text-align: center;
    }
</style>
<body>
    <section>
        @include('components.navbaradmin')
        <div>
            <h1>Halaman Data layanan</h1>
        </div>
    </section>
    <section>

        <table class="table">
            <thead>
                <tr>
                    <th>Layanan ID</th>
                    <th>Vendor ID</th>
                    <th>Jenis Layanan</th>
                    <th>Jenis Detail Layanan</th>
                    <th>Nama Layanan</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanans as $pesanan)
                    <tr>
                        <td>{{ $pesanan->id }}</td>
                        <td>{{ $pesanan->vendor_id }}</td>
                        <td>{{ $pesanan->jenis_pesanan }}</td>
                        <td>{{ $pesanan->jenis_detail }}</td>
                        <td>{{ $pesanan->nama_pesanan }}</td>
                        <td>{{ $pesanan->lokasi_provinsi }}</td>
                        <td>{{ $pesanan->lokasi_kota }}</td>
                        <td>{{ $pesanan->lokasi_kecamatan }}</td>
                        <td>{{ $pesanan->lokasi_kelurahan }}</td>
                        <td>{{ $pesanan->status }}</td>
                        <td>
                            <form id="statusForm{{ $pesanan->id }}" action="{{ route('statusbayar', ['id' => $pesanan->id]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="statusButton" style="background-color: {{ $pesanan->status == 'berbayar' ? 'red' : 'blue' }}; color: white;" {{ $pesanan->status == 'berbayar' ? 'disabled' : '' }}>
                                    {{ $pesanan->status == 'berbayar' ? 'berbayar' : 'bayar' }}
                                </button>
                            </form>
                        </td>
                    </tr>


                @endforeach
            </tbody>
        </table>
        {{ $pesanans->links() }}
    </section>
</body>
</html>
