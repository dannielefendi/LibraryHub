<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    // public function handle(Request $request, Closure $next, ...$guards)
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {
    //         if (Auth::guard($guard)->check()) {
    //             // Cek role user yang sedang login
    //             $user = Auth::user();

    //             if ($user->role === 'admin') {
    //                 return redirect('/books'); // admin langsung ke halaman CRUD
    //             } else {
    //                 return redirect('/dashboard'); // user biasa ke dashboard
    //             }
    //         }
    //     }

    //     return $next($request);
    // }
}
