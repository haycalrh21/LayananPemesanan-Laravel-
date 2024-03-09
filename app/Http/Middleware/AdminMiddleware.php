<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('admin')->user();

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        dd('AdminMiddleware blocked access', $user);
        // Output pesan debug
        // Atau gunakan Log::info('AdminMiddleware blocked access'); untuk menyimpan pesan log

        return redirect('/')->with('error', 'Unauthorized');
    }
}
