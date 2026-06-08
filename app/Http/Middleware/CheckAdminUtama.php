<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminUtama
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = strtolower((string) $request->session()->get('auth_role', ''));

        if (
            ! $request->session()->has('auth_id') ||
            $request->session()->get('auth_type') !== 'pengelola' ||
            ! in_array($role, ['super_admin', 'admin_utama'], true)
        ) {
            abort(403, 'Hanya admin utama yang dapat mengelola akun admin.');
        }

        return $next($request);
    }
}
