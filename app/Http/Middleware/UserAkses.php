<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (auth()->user()->role == $role) {
            return $next($request);
        }
        notyf()->ripple(true)->addWarning('MAAF ANDA TIDAK DI PERBOLEHKAN MENGAKSES HALAMAN INI.');
        return redirect('beranda');

    }
}
