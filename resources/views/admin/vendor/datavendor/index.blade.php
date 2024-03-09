<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data User</title>
</head>
<body>
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        .table, th, td {
            border: 1px solid #080808;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #0b0b0b;
            color: white;
        }
    </style>
<section>
    @include('components.navbaradmin')
    <h1>Data Vendor</h1>
</section>

<section>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>

                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Role</th>
                <th>Np Handphone</th>
                <th>Alamat</th>
                <th>Nama Vendor</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->id }}</td>
                    <td>{{ $vendor->user_id }}</td>

                    <td>{{ $vendor->name }}</td>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ $vendor->nohp }}</td>
                    <td>{{ $vendor->alamat }}</td>
                    <td>{{ $vendor->vendor }}</td>


                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $vendors->links() }}

</section>
</body>
</html>
