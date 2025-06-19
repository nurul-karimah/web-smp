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
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   * @param /Closure $next
   * @param string|null ..$guard
   * @return mixed
   */
  public function handle(Request $request, Closure $next, ...$guard): Response
  {
    if (!Auth::guard('web')->check()) {
      return redirect()->route('loginOrangtua')->with('error', 'Silahkan Login Terlebih dahulu');
    }
    return $next($request);
  }
}
