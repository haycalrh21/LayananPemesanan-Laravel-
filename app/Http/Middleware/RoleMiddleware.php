<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Memeriksa apakah pengguna sudah login
        if (!$request->user()) {
            return redirect('/login'); // atau sesuaikan dengan rute login Anda
        }

        // Logika untuk memeriksa peran pengguna
        if ($request->user()->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
