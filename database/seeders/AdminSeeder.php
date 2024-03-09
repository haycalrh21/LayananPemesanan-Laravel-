<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama jika ada
        DB::table('admins')->truncate();

        // Insert data admin
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
    }
}
