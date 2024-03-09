<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        return view('home.index');
    }
    public function formvendor(){
        return view ('home.menjadivendor.index');
    }





    public function daftar(Request $request)
    {
        try {
            // Validasi email tidak boleh duplikat sebelum menyimpan
            $request->validate([
                'name' => 'required|unique:vendors,name',
                'email' => 'required|unique:vendors,email',
                'alamat' => 'required|unique:vendors,alamat',
                'nohp' => 'required|unique:vendors,nohp',
                'vendor' => 'required|unique:vendors,vendor',
                'gambar_ktp' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'gambar_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'gambar_banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Dapatkan ID pengguna yang sedang login
            $loggedInUserId = Auth::id();

            // Simpan data ke dalam tabel 'vendors' berdasarkan pengguna yang login
            $vendor = new Vendor;
            $vendor->name = $request->name;
            $vendor->email = $request->email;
            $vendor->alamat = $request->alamat;
            $vendor->nohp = $request->nohp;
            $vendor->gambar_ktp = $request->gambar_ktp;
            $vendor->gambar_logo = $request->gambar_logo;
            $vendor->gambar_banner = $request->gambar_banner;
            $vendor->vendor = $request->vendor;
        $vendor->user_id = $loggedInUserId;
        $vendor->save();

        // Dapatkan ID vendor yang baru dibuat
        $vendorId = $vendor->id;

        // Buat folder untuk vendor menggunakan ID-nya di dalam folder 'public/storage/vendors'
        $folderPath = "vendors/$vendorId";
        $gambarPath = "public/storage/$folderPath";

        if (!file_exists($gambarPath)) {
            mkdir($gambarPath, 0755, true);
        }

        // Simpan gambar di dalam folder vendor
        if ($request->hasFile('gambar_ktp')) {
            $gambarKTP = $request->file('gambar_ktp');
            $gambarKTP->storeAs($folderPath, "gambar_ktp.jpg", 'public');
        }

        if ($request->hasFile('gambar_logo')) {
            $gambarLogo = $request->file('gambar_logo');
            $gambarLogo->storeAs($folderPath, "gambar_logo.jpg", 'public');
        }

        if ($request->hasFile('gambar_banner')) {
            $gambarBanner = $request->file('gambar_banner');
            $gambarBanner->storeAs($folderPath, "gambar_banner.jpg", 'public');
        }

        // Ubah peran pengguna yang login menjadi 'vendor'
        Auth::user()->update(['role' => 'vendor']);

        // ... tambahkan logika lainnya

        return redirect('/')->with('success', 'Data berhasil disimpan');
    } catch (ValidationException $e) {
        return redirect()->back()->withInput()->withErrors(['error' => 'Data sudah ada di database']);
    }
}


}
