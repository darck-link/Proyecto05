<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReservaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $reserva = $request->route('reserva');
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Si el usuario NO es admin y NO es el dueño de la reserva, denegar acceso
        if (!$user->hasRole('admin') && $reserva->user_id != $user->id) {
            abort(403, 'No tienes permisos para acceder a esta reserva.');
        }
        
        return $next($request);
    }
}