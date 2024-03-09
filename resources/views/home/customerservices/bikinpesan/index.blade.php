<!-- resources/views/messages/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kirim Pesan</title>
</head>
<body>

    <h1>Kirim Pesan</h1>

    <form action="{{ route('kirimpesan') }}" method="post">
        @csrf
        <label for="content">Isi Pesan:</label>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <br>
        <button type="submit">Kirim</button>
    </form>

</body>
</html>
