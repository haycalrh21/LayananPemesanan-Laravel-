<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mendapatkan pesan dan balasan untuk pengguna yang sedang login
        $messages = Message::where('user_id', $user->id)->with('replies')->get();

        return view('home.customerservices.index', compact('messages'));
    }


   public function bikinpesan(){
    return view ('home.customerservices.bikinpesan.index');
   }

            public function kirim(Request $request){
            $request->validate([
                'content'=>'required|string',
            ]);


            Message::create([
                'user_id'=> auth()->id(),
                'content'=> $request->input('content')
            ]);

            return redirect()->route('bikinpesan');
            }
            }
