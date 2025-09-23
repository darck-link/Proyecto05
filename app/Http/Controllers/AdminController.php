<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reserva;
use App\Models\Servicio;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        if (!$user->hasRole('admin')) {
            abort(403, 'Acceso denegado. Se requieren permisos de administrador.');
        }

        $totalUsuarios = User::count();
        $totalReservas = Reserva::count();
        $totalServicios = Servicio::count();
        $reservasRecientes = Reserva::with(['user', 'servicio'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsuarios', 
            'totalReservas', 
            'totalServicios', 
            'reservasRecientes'
        ));
    }
}