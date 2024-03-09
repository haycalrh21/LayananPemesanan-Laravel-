<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class PesananController extends Controller
{
    public function index()
    {


        return view('vendor.buatpesanan');
}

public function vendordetail($nama_pesanan_id) {

    // Pisahkan $nama_pesanan_id menjadi $nama_pesanan dan $id
    list($nama_pesanan, $id) = explode('_id_', $nama_pesanan_id);

    $pesanan = Pesanan::where('nama_pesanan', $nama_pesanan)->where('id', $id)->first();

    // Jika pesanan tidak ditemukan, bisa menangani dengan redirect atau menampilkan pesan error
    if (!$pesanan) {
        return redirect()->route('vendordetail')->with('error', 'Pesanan tidak ditemukan.');
    }

    // Kirim data pesanan ke view detail
    return view('home.layanan.detail.index', ['pesanan' => $pesanan]);
}




    public function form(Request $request)
    {
        try {
            $request->validate([
                'vendor_id' => 'required|exists:vendors,id',
                'user_id' => 'required|exists:users,id',
                'jenis_pesanan' => 'required',
                'jenis_detail' => 'required',
                'nama_pesanan' => 'required',
                'lokasi_provinsi' => 'required',
                'lokasi_kota' => 'required',
                'lokasi_kecamatan' => 'required',
                'lokasi_kelurahan' => 'required',
                'deskripsi' => 'required',
                'publish' => 'required',
                'status' => 'required|in:free,berbayar',
                'gambar_pesanan.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Fetch names from the EMSIFA API
            $provinsiId = $request->input('lokasi_provinsi');
            $kotaId = $request->input('lokasi_kota');
            $kecamatanId = $request->input('lokasi_kecamatan');
            $kelurahanId = $request->input('lokasi_kelurahan');

            $provinsi = $this->getNameFromAPI('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', $provinsiId);
            $kota = $this->getNameFromAPI("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinsiId}.json", $kotaId);
            $kecamatan = $this->getNameFromAPI("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$kotaId}.json", $kecamatanId);
            $kelurahan = $this->getNameFromAPI("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$kecamatanId}.json", $kelurahanId);

            // Simpan pesanan ke database
            $pesananData = [
                'vendor_id' => $request->input('vendor_id'),
                'user_id' => $request->input('user_id'),
                'jenis_pesanan' => $request->input('jenis_pesanan'),
                'jenis_detail' => $request->input('jenis_detail'),
                'nama_pesanan' => $request->input('nama_pesanan'),
                'lokasi_provinsi' => $provinsi,
                'lokasi_kota' => $kota,
                'lokasi_kecamatan' => $kecamatan,
                'lokasi_kelurahan' => $kelurahan,
                'deskripsi' => $request->input('deskripsi'),
                'publish' => $request->input('publish'),

                'status' => $request->input('status'),
            ];

            $pesanan = Pesanan::create($pesananData);

            // Proses unggahan gambar
            if ($request->hasFile('gambar_pesanan')) {
                $gambarPaths = [];
                foreach ($request->file('gambar_pesanan') as $file) {
                    $path = $file->store('gambar_pesanan', 'public');
                    $gambarPaths[] = $path;
                }
                $pesanan->gambar_pesanan = $gambarPaths;
                $pesanan->save();
            }

            return redirect('/')->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            // Tangkap pesan kesalahan dan log
            Log::error('Error in PesananController@form: ' . $e->getMessage());
            return redirect('/')->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }



    private function getNameFromAPI($url, $id)
{
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    foreach ($data as $item) {
        if ($item['id'] == $id) {
            return $item['name'];
        }
    }

    return null;
}

    public function vendorlayanan(){
        $pesanans = Pesanan::all();
        $vendors = Vendor::all();
        // dd($pesanans);
        return view('vendor.index', compact('pesanans','vendors'));
    }



}

