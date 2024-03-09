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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Tambahkan kolom 'user_id'
            $table->foreign('user_id')->references('id')->on('users'); // Tambahkan foreign key ke tabel 'users'
            $table->string('name');
            $table->string('email');
            $table->string('nohp');
            $table->string('alamat');
            $table->string('vendor');
            $table->string('gambar_ktp');

            $table->string('gambar_logo')->nullable();
            $table->string('gambar_banner')->nullable();



            $table->rememberToken();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
