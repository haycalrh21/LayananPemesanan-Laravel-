<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pesanan</title>
</head>

<style>
    h2 {
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    max-width: 400px;
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
}

button {
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

select {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    box-sizing: border-box;
}


select option {
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 5px;
}

textarea {
        width: 100%;
        height: 100px;
        resize: vertical;
        overflow-y: scroll;
    }
</style>
<body>
    <section>
        @include('components.navbar')
    </section>
    <h2>Form Layanan</h2>
    <form action="{{ route('prosespesanan') }}" method="post" enctype="multipart/form-data">

        @csrf

        {{-- Ambil vendor_id dari vendor yang sedang login --}}
        <input type="hidden" name="vendor_id" value="{{ Auth::user()->id }}">

        {{-- Ambil user_id dari user yang sedang login --}}
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <label for="jenis_pesanan">Jenis Pesanan:</label>
        <!-- Dropdown untuk Jenis Pesanan -->
        <select name="jenis_pesanan" id="jenis_pesanan" required>
            <option value="laut">--Pilih--</option>
            <option value="laut">Laut</option>
            <option value="udara">Udara</option>
            <option value="darat">Darat</option>
        </select><br>





        <label for="jenis_detail">Jenis Detail:</label>
        <!-- Dropdown untuk Jenis Detail -->
        <select name="jenis_detail" id="jenis_detail" required>
            <!-- Opsi akan diisi menggunakan JavaScript -->
        </select><br>

        <label for="nama_pesanan">Nama Pesanan:</label>
        <input type="text" name="nama_pesanan" required><br>
        <!-- Dropdown untuk Provinsi -->
        <label for="lokasi_provinsi">Lokasi Provinsi:</label>
        <select name="lokasi_provinsi" id="lokasi_provinsi" value="lokasi_provinsi" required>
            <!-- Opsi akan diisi menggunakan JavaScript -->
        </select><br>

        <!-- Dropdown untuk Kota -->
        <label for="lokasi_kota">Lokasi Kota:</label>
        <select name="lokasi_kota" id="lokasi_kota"  required>
            <!-- Opsi akan diisi menggunakan JavaScript -->
        </select><br>

        <!-- Dropdown untuk Kecamatan -->
        <label for="lokasi_kecamatan">Lokasi Kecamatan:</label>
        <select name="lokasi_kecamatan" id="lokasi_kecamatan" value="lokasi_kecamatan"  required>
            <!-- Opsi akan diisi menggunakan JavaScript -->
        </select><br>


        <label for="lokasi_kelurahan">Lokasi Kecamatan:</label>
        <select name="lokasi_kelurahan" id="lokasi_kelurahan"  value="lokasi_kelurahan" required>
            <!-- Opsi akan diisi menggunakan JavaScript -->
        </select><br>



        <label for="gambar_pesanan">Gambar Pesanan:</label>
        <input type="file" name="gambar_pesanan[]" accept="image/*" multiple><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" rows="4" cols="50" required></textarea><br>

        <button type="submit">Proses Pesanan</button><br>



        <label for="status" style="display: none;">Status:</label>
        <select name="status" required style="visibility: hidden;">
            <option value="free" selected>--Silahkan Pilih--</option>
            <option value="free">Free</option>
            <option value="berbayar">Berbayar</option>
        </select><br>
        <label for="publish" hidden>Status:</label>
<select name="publish" required hidden>
    <option value="publish" selected>--Silahkan Pilih--</option>
    <option value="publish">Publish</option>
    <option value="nonpublish">Non-Publish</option>
</select><br>


    </form>
</body>

<script>
    // Menambahkan event listener untuk perubahan pada jenis_pesanan
    document.getElementById('jenis_pesanan').addEventListener('change', function() {
        var jenisDetailSelect = document.getElementById('jenis_detail');
        // Menghapus opsi yang sudah ada
        jenisDetailSelect.innerHTML = "";

        // Menyesuaikan opsi berdasarkan jenis_pesanan yang dipilih
        switch(this.value) {
            case 'laut':
                jenisDetailSelect.add(new Option('Kapal Kontainer', 'Kapal Kontainer'));
                jenisDetailSelect.add(new Option('Kapal Barang Umum ', 'Kapal Barang Umum'));
                jenisDetailSelect.add(new Option('Kapal Pesiar', 'Kapal Pesiar'));
                jenisDetailSelect.add(new Option('Kapal Kargo Beratr', 'Kapal Kargo Berat'));
                jenisDetailSelect.add(new Option('Kapal Ferry', 'Kapal Ferry'));

                jenisDetailSelect.add(new Option('Yacht', 'Yacht'));

                // Tambahkan opsi lain sesuai kebutuhan
                break;
            case 'udara':
                jenisDetailSelect.add(new Option('Jet Pribadi', 'Jet Pribadi'));
                jenisDetailSelect.add(new Option('Pesawat Kargo', 'Pesawat Kargo'));
                // Tambahkan opsi lain sesuai kebutuhan
                break;
            case 'darat':
                jenisDetailSelect.add(new Option('Alat Berat', 'Alat Berat'));
                jenisDetailSelect.add(new Option('Mobil', 'Mobil'));
                jenisDetailSelect.add(new Option('Bak Kargo', 'Bak Kargo'));
                jenisDetailSelect.add(new Option('Bus Pariwisata', 'Bus Pariwisata'));
                jenisDetailSelect.add(new Option('Truck Gandeng 1', 'Truck Gandeng 1'));
                jenisDetailSelect.add(new Option('Truck Gandeng 2', 'Truck Gandeng 2'));
                // Tambahkan opsi lain sesuai kebutuhan
                break;
            default:
                // Default jika jenis_pesanan tidak cocok
                jenisDetailSelect.add(new Option('Pilih Jenis Detail', ''));
        }
    });

    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(provinces => {
                // Isi dropdown provinsi dengan opsi dari API
                const provinsiDropdown = document.getElementById('lokasi_provinsi');
                provinces.forEach(provinsi => {
                    const option = document.createElement('option');
                    option.value = provinsi.id;
                    option.text = provinsi.name;
                    provinsiDropdown.add(option);
                });
            });

        // Event listener untuk perubahan pada dropdown Provinsi
        document.getElementById('lokasi_provinsi').addEventListener('change', function() {
            // Dapatkan id provinsi yang dipilih
            const provinsiId = this.value;

            // Panggil API untuk mendapatkan data kota berdasarkan id provinsi
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`)
                .then(response => response.json())
                .then(regencies => {
                    // Isi dropdown kota dengan opsi dari API
                    const kotaDropdown = document.getElementById('lokasi_kota');
                    kotaDropdown.innerHTML = "<option>-- Pilih Kota --</option>"; // Reset dropdown
                    regencies.forEach(kota => {
                        const option = document.createElement('option');
                        option.value = kota.id;
                        option.text = kota.name;
                        kotaDropdown.add(option);
                    });
                });
        });

        // Event listener untuk perubahan pada dropdown Kota
        document.getElementById('lokasi_kota').addEventListener('change', function() {
            // Dapatkan id kota yang dipilih
            const kotaId = this.value;

            // Panggil API untuk mendapatkan data kecamatan berdasarkan id kota
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`)
                .then(response => response.json())
                .then(districts => {
                    // Isi dropdown kecamatan dengan opsi dari API
                    const kecamatanDropdown = document.getElementById('lokasi_kecamatan');
                    kecamatanDropdown.innerHTML = "<option>-- Pilih Kecamatan --</option>"; // Reset dropdown
                    districts.forEach(kecamatan => {
                        const option = document.createElement('option');
                        option.value = kecamatan.id;
                        option.text = kecamatan.name;
                        kecamatanDropdown.add(option);
                    });
                });
        });
        document.getElementById('lokasi_kecamatan').addEventListener('change', function() {
        // Dapatkan id kecamatan yang dipilih
        const kecamatanId = this.value;

        // Panggil API untuk mendapatkan data kelurahan berdasarkan id kecamatan
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
            .then(response => response.json())
            .then(villages => {
                // Isi dropdown kelurahan dengan opsi dari API
                const kelurahanDropdown = document.getElementById('lokasi_kelurahan');
                kelurahanDropdown.innerHTML = "<option>-- Pilih Kelurahan --</option>"; // Reset dropdown
                villages.forEach(kelurahan => {
                    const option = document.createElement('option');
                    option.value = kelurahan.id;
                    option.text = kelurahan.name;
                    kelurahanDropdown.add(option);
                });
            });
    });

</script>
</html>
