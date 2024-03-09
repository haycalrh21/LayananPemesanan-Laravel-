<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Vendor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>

h2 {
    text-align: center;
}

form {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    max-width: 800px;
    margin: 0 auto;
}

label {
    margin-bottom: 5px;
}

input {
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
}

button {
    grid-column: span 2;
    padding: 10px;
    background-color: #3498db;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #2980b9;
}

</style>
<body>

<section>
    @include('components.navbar')
</section>

<h2>Form Pendaftaran Vendor</h2>
<form action="{{ route('daftar') }}" method="post" class="rounded-form" enctype="multipart/form-data">
    @csrf
    <label for="name">Nama Lengkap:</label>
    <input type="text" name="name" value="{{ auth()->user()->name }}" required>

    <label for="name">Alamat:</label>
    <input type="text" name="alamat" placeholder="Masukkan alamat" required>

    <label for="email">Email:</label>
    <input type="email" name="email" placeholder="Masukkan email yang sedang login" value="{{ auth()->user()->email }}" required>

    <label for="nohp">Nomor Hape:</label>
    <input type="text" id="nohp" name="nohp" placeholder="Masukkan nomor handphone" required>

    <label for="vendor">Masukkan Nama Vendor:</label>
    <input type="text" name="vendor" placeholder="Masukkan nama vendor" required>

    <label for="gambar_ktp">Gambar KTP:</label>
    <input type="file" name="gambar_ktp" accept="image/*" required>

    <label for="gambar_logo">Gambar Logo:</label>
    <input type="file" name="gambar_logo" accept="image/*" required>

    <label for="gambar_banner">Gambar Banner:</label>
    <input type="file" name="gambar_banner" accept="image/*" required>

    <button type="submit">Daftar sebagai Vendor</button>
</form>

<script>
    document.getElementById('nohp').addEventListener('input', function(event) {
      // Hanya tambahkan awalan +62 jika belum ada
      if (!event.target.value.startsWith('+62')) {
        event.target.value = '+62' + event.target.value;
      }
    });
</script>
</body>
</html>
