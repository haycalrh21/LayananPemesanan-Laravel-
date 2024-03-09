<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Message;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
public function index(){
    $userCount = User::count();
    $orderCount = Pesanan::count();
    $vendorCount = Vendor::count();
    return view('admin.index', compact('userCount','orderCount','vendorCount'));
}


public function layanan(){
    $pesanans = Pesanan::paginate(20);
    return view('admin.vendor.layanan.index', compact('pesanans'));
}

public function pesan(){
$messages= Message::all();
return view('admin.pesan.index', compact('messages'));

}


public function balesPesan(Request $request, $id)
{
    $message = Message::findOrFail($id);

    // Validasi request jika diperlukan
    $request->validate([
        'adminReply' => 'required|string',
    ]);

    // Simpan balasan ke dalam tabel replies
    $reply = $message->replies()->create([
        'content' => $request->input('adminReply'),
        'is_admin_reply' => true,
    ]);

    // Redirect atau lakukan tindakan lainnya
    return redirect()->back()->with('success', 'Balasan berhasil dikirim!');
}
public function statusbayar(Request $request,$id){
    $pesanans= Pesanan::findorFail($id);

    if($pesanans->status== 'free'){
        $pesanans->update(['status'=>'berbayar']);
    }
    return redirect()->back()->with('success', 'Status berhasil diubah');

}


public function statusvendor(Request $request,$id){
    $vendors= User::findorFail($id);

    if($vendors->role== 'user'){
        $vendors->update(['role'=>'vendor']);
    }
    return redirect()->back()->with('success', 'Status berhasil diubah');

}
public function user(){
    $users = User::where('role', 'user')->get();
    return view('admin.user.index', compact('users'));
}

public function vendor(){
    $vendors = Vendor::paginate(20);


    return view('admin.vendor.datavendor.index', compact('vendors'));
}


}
