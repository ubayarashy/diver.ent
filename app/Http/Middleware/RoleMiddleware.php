<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        // Cek apakah role user sesuai
        if (auth()->user()->role !== $role) {
            abort(403, 'Unauthorized access. You need ' . $role . ' privileges.');
        }
        
        return $next($request);
    }
}