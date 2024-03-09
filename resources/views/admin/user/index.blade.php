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
    <h1>Data User</h1>
</section>

<section>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>

                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Role</th>

                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>

                    <td>
                        <form id="statusForm{{ $user->id }}" action="{{ route('statusvendor', ['id' => $user->id]) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="statusButton" style="background-color: {{ $user->role == 'user' ? 'red' : 'blue' }}; color: white;" {{ $user->status == 'user' ? 'disabled' : '' }}>
                                {{ $user->role == 'user' ? 'user' : 'vendor' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
</body>
</html>
