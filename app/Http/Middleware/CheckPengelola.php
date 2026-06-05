<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPengelola
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            ! $request->session()->has('auth_id') ||
            $request->session()->get('auth_type') !== 'pengelola'
        ) {
            return redirect('/login')->withErrors([
                'auth' => 'Silakan login sebagai pengelola terlebih dahulu.',
            ]);
        }

        return $next($request);
    }
}
