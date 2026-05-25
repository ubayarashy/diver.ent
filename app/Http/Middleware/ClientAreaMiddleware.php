<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientAreaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = Auth::user();
        
        // Cek role user (hanya client yang bisa akses)
        // Jika menggunakan role: client, admin, dll
        if (isset($user->role) && $user->role !== 'client' && $user->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda bukan client terdaftar.');
        }

        // Cek status user (active/suspended)
        if (isset($user->status) && $user->status === 'suspended') {
            Auth::logout();
            return redirect('/')->with('error', 'Akun Anda sedang ditangguhkan. Hubungi admin.');
        }

        // Cek email verification (jika diperlukan)
        if (config('auth.verification.enabled') && is_null($user->email_verified_at)) {
            return redirect('/verify-email')->with('warning', 'Harap verifikasi email Anda terlebih dahulu.');
        }

        // Log activity (opsional)
        // activity()->log($user->name . ' mengakses Client Area');

        return $next($request);
    }
}