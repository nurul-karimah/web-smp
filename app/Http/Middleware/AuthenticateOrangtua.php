<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateOrangtua
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
       if (!Auth::guard('orangtua')->check()) {
    logger('Tidak lolos middleware orangtua');
    return redirect()->route('loginOrangtua')->with('error', 'Silakan login terlebih dahulu');
    }


        return $next($request);
    }
}
