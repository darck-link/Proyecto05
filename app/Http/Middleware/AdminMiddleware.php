<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Verificar si el usuario está autenticado y tiene rol de admin
        if (!$user || !$user->hasRole('admin')) {
            abort(403, 'Acceso denegado. Se requieren permisos de administrador.');
        }
        
        return $next($request);
    }
}