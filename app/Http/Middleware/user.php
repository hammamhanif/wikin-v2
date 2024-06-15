<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class user
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Periksa apakah user terautentikasi dan memiliki tipe tertentu
        if ($user && in_array($user->type, ['admin', 'dosen', 'mahasiswa'])) {
            return $next($request);
        }
        return redirect()->route('dashboard');
    }
}
