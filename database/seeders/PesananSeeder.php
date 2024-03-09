<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat 100 pesanan
        for ($i = 1; $i <= 100; $i++) {
            DB::table('pesanans')->insert([
                'vendor_id' => random_int(1, 10), // Ganti dengan batas yang sesuai dengan jumlah vendor yang ada
                'user_id' => random_int(1, 20), // Ganti dengan batas yang sesuai dengan jumlah user yang ada
                'jenis_pesanan' => 'laut', // Ganti sesuai kebutuhan
                'jenis_detail' => 'kapal kontainer', // Ganti sesuai kebutuhan
                'nama_pesanan' => 'Pesanan ' . $i,
                'gambar_pesanan' => json_encode(['gambar1.jpg', 'gambar2.jpg']), // Ganti sesuai kebutuhan
                'lokasi_provinsi' => 'Provinsi ' . $i,
                'lokasi_kota' => 'Kota ' . $i,
                'lokasi_kecamatan' => 'Kecamatan ' . $i,
                'lokasi_kelurahan' => 'Kelurahan ' . $i,
                'deskripsi' => 'Deskripsi pesanan ' . $i,
                'status' => ($i % 2 == 0) ? 'berbayar' : 'free', // Ganti sesuai kebutuhan
                'publish' => ($i % 2 == 0) ? 'publish' : 'nonpublish', // Ganti sesuai kebutuhan
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
