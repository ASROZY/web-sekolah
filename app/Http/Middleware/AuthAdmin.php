<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->type == 1 or Auth::user()->type == 2) {
                return $next($request);
            } elseif (Auth::user()->type == 0) {
                return redirect('siswa/dashboard');
            } else {
                return redirect('ppdb/daftar');
            }
        } else {
            return redirect('login');
        }
    }
}
