<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();

            // ID vendor yang akan menerima pesanan
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');

            // ID user yang melakukan pesanan
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // Jenis pesanan (laut, udara, darat)
            $table->string('jenis_pesanan');

            // Jenis detail pesanan (kapal kontainer, jet pribadi, pesawat kargo, dll.)
            $table->string('jenis_detail');

            // Nama pesanan
            $table->string('nama_pesanan');

            // Informasi gambar pesanan (multiple gambar, dapat disimpan sebagai array JSON)
            $table->string('gambar_pesanan')->nullable();

            // Informasi lokasi pesanan (provinsi, kota, kecamatan, kelurahan)
            $table->string('lokasi_provinsi');
            $table->string('lokasi_kota');
            $table->string('lokasi_kecamatan');
            $table->string('lokasi_kelurahan');
            $table->text('deskripsi');



            $table->enum('status', ['free', 'berbayar'])->default('free');
            $table->enum('publish', ['publish', 'nonpublish'])->default('publish')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
