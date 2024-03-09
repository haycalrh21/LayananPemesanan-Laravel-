<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {

        return view('auth.login');
    }

    public function proseslogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::user();
            $role = $user->role;

            $token = JWTAuth::fromUser($user);

            if ($role === 'vendor') {
                return redirect()->route('profile')->header('Authorization', 'Bearer ' . $token);
            } elseif ($role === 'user') {
                return redirect('/')->header('Authorization', 'Bearer ' . $token);
            }
        } elseif (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();

            $token = JWTAuth::fromUser($admin);

            // Simpan token di sesi atau cookie
            $request->session()->put('admin_token', $token);

            // Redirect to admin dashboard or any admin-specific page
            return redirect()->route('admin.index')->header('Authorization', 'Bearer ' . $token);
        } else {
            Log::info('Authentication failed');
        }

        return redirect()->route('login')->with('error', 'Login failed');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::logout();
        return redirect('/');
    }
}
