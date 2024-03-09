<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    protected $fillable = [
        'vendor_id', 'user_id', 'jenis_pesanan', 'jenis_detail', 'nama_pesanan',
        'gambar_pesanan', 'lokasi_provinsi', 'lokasi_kota', 'lokasi_kecamatan',
        'lokasi_kelurahan', 'status','deskripsi','publish'
    ];


    public function vendor(){
        return $this->belongsTo(Vendor::class , 'vendor_id');


    }

    public function user(){
        return $this->belongsTo(User::class,'id');
    }
}
