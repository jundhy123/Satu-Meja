<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu.');
        }

        if ($user->status === 'rejected') {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Akun Anda telah ditolak oleh Admin.');
        }

        if ($user->status === 'pending') {
            return redirect()->back()->with('error', 'Akun Anda masih dalam status Menunggu Verifikasi oleh Admin. Anda belum dapat mempublikasikan atau mengklaim donasi.');
        }

        return $next($request);
    }
}
