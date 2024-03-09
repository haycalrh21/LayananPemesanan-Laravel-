<?php

namespace App\Http\Controllers;

use App\Models\Vendor;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function index(){

$pesanans = Pesanan::all();

        return view('home.index', compact('pesanans'));
    }


    public function layanan(Request $request)
    {
        $pesanans = Pesanan::where('publish', 'publish')->paginate(10);

        if ($request->ajax()) {
            return response()->json($pesanans);
        }

        $vendors = Vendor::all();
        return view('home.layanan.index', compact('pesanans', 'vendors'));
    }







    public function layanansort($jenis_pesanan){
       // Ambil data pesanan berdasarkan jenisnya
    $pesanan = Pesanan::where('jenis_pesanan', strtolower($jenis_pesanan))->paginate(10);

    // Pilih tampilan berdasarkan jenis pesanan
    $viewName = 'layanan.' . strtolower($jenis_pesanan);
    $vendors = Vendor::all();
    // Kirim data pesanan ke tampilan
    return view($viewName, compact('pesanan', 'jenis_pesanan','vendors'));
    }



public function search(Request $request)
{
    $keyword = $request->input('keyword');

    // Jika keyword tidak ada, redirect kembali ke halaman sebelumnya
    if (!$keyword) {
        return redirect()->back();
    }

    // Menggunakan relasi antara Pesanan dan Vendor (asumsikan relasi bernama 'vendor')
    $pesanans = Pesanan::whereHas('vendor', function ($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%')
              ->orWhere('email', 'like', '%' . $keyword . '%');
    })->orWhere('nama_pesanan', 'like', '%' . $keyword . '%')->get();

    // Jika tidak ada hasil pencarian, kembalikan ke halaman sebelumnya
    if ($pesanans->isEmpty()) {
        return redirect()->back()->with('message', 'Tidak ada hasil yang ditemukan untuk kata kunci: ' . $keyword);
    }

    return view('home.cari', ['pesanans' => $pesanans, 'keyword' => $keyword]);
}


public function company($id) {
    // Mendapatkan data vendor berdasarkan ID
    $vendor = Vendor::find($id);

    // Pastikan vendor ditemukan
    if (!$vendor) {
        return redirect()->route('home')->with('error', 'Vendor not found');
    }

    // Inisialisasi variabel $folderPath
    $folderPath = "vendors/{$vendor->id}";

    // Jika user login, dapatkan user ID
    $userId = Auth::id();

    // Mendapatkan pesanan berdasarkan vendor_id
    $pesanans = Pesanan::where('vendor_id', $vendor->id);

    // Jika user login dan bukan vendor yang bersangkutan
    if ($userId && $vendor->user_id !== $userId) {
        // Tampilkan semua pesanan tanpa memfilter berdasarkan user_id
        $pesanans = $pesanans->get();
    } else {
        // Jika vendor yang sedang login atau user tidak login, filter berdasarkan user_id (jika login)
        if ($userId) {
            $pesanans = $pesanans->where('user_id', $userId);
        }

        $pesanans = $pesanans->get();
    }

    // Menampilkan halaman vendor, tanpa memeriksa status login pengguna
    return view('home.vendor.index', compact('pesanans', 'vendor', 'folderPath', 'userId'));
}








}
