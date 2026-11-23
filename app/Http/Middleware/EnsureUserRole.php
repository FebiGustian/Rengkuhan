<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $requiredRole (volunteer|pengurus|admin)
     */
    public function handle(Request $request, Closure $next, string $requiredRole): Response
    {
        $authId = session('auth_id');
        $authRole = session('auth_role');
        $authJabatan = session('auth_jabatan');

        if (!$authId || !$authRole) {
            return redirect('/login/' . ($requiredRole === 'volunteer' ? 'volunteer' : 'mandala'))
                ->with('error', 'Silakan masuk terlebih dahulu untuk mengakses halaman ini.');
        }

        if ($requiredRole === 'admin') {
            if ($authRole !== 'mandala' || $authJabatan !== 'Administrator') {
                abort(403, 'Akses khusus Administrator.');
            }
        } elseif ($requiredRole === 'pengurus' || $requiredRole === 'mandala') {
            if ($authRole !== 'mandala') {
                abort(403, 'Akses khusus Pengurus Ranah Rengkuh.');
            }
        } elseif ($requiredRole === 'volunteer') {
            if ($authRole !== 'volunteer') {
                abort(403, 'Akses khusus Volunteer.');
            }
        }

        return $next($request);
    }
}
