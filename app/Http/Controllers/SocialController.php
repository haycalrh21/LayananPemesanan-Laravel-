<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect()
    {

        $response = Socialite::driver('google')->redirect();


        return $response;
    }


    public function callback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();

            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                // Jika pengguna belum terdaftar, tambahkan ke database
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'role' => 'user',
                    'password' => bcrypt(''), // Ini sebaiknya menggunakan fitur autentikasi Laravel yang sesuai
                ]);
            }

            // Logika untuk login atau proses selanjutnya
            auth()->login($user);

            // Redirect atau proses lanjutan
            if ($user->role === 'vendor' && $user->vendor) {
                return redirect()->route('profile', ['vendorId' => $user->vendor->id]);
            } else {
                return redirect()->route('/');
            }
        } catch (\Exception $e) {
            $errorMessage = 'Error handling Google callback: ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine();
            Log::error($errorMessage);
            return redirect()->route('login')->with('error', 'Login failed. An error occurred: ' . $errorMessage);
        }
    }


}
