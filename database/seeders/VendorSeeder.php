<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'Nama Pengguna ' . $i,
                'email' => 'vendor' . $i . '@example.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('vendors')->insert([
                'user_id' => $userId,
                'name' => 'Vendor ' . $i,
                'email' => 'vendor' . $i . '@example.com',
                'nohp' => '08123456789', // Ganti dengan nohp yang sesuai
                'alamat' => 'Alamat Vendor ' . $i,
                'vendor' => 'Nama Vendor ' . $i,
                'gambar_ktp' => 'gambar_ktp_vendor' . $i . '.jpg', // Ganti dengan gambar KTP yang sesuai
                'gambar_logo' => 'gambar_logo_vendor' . $i . '.jpg', // Ganti dengan gambar logo yang sesuai
                'gambar_banner' => 'gambar_banner_vendor' . $i . '.jpg', // Ganti dengan gambar banner yang sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
