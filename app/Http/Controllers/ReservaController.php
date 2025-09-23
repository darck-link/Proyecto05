<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reserva;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ✅ USUARIOS REGULARES solo ven SUS reservas, ADMIN ve todas
        if ($user->hasRole('admin')) {
            $query = Reserva::with(['servicio', 'user']);
        } else {
            $query = Reserva::with(['servicio', 'user'])->where('user_id', $user->id);
        }

        if ($q) {
            $query->whereHas('user', function($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%");
                })
                ->orWhereHas('servicio', function($sub) use ($q) {
                    $sub->where('nombre', 'like', "%{$q}%");
                });
        }

        $reservas = $query->orderBy('fecha', 'desc')->paginate(10)->withQueryString();

        return view('reservas.index', compact('reservas', 'q'));
    }

    // ✅ Método para admin ver todas las reservas (vista especial)
    public function adminIndex(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!$user->hasRole('admin')) {
            abort(403, 'Acceso denegado.');
        }

        $q = $request->input('q');
        $query = Reserva::with(['servicio', 'user']);

        if ($q) {
            $query->whereHas('user', function($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%");
                })
                ->orWhereHas('servicio', function($sub) use ($q) {
                    $sub->where('nombre', 'like', "%{$q}%");
                });
        }

        $reservas = $query->orderBy('fecha', 'desc')->paginate(10)->withQueryString();

        return view('admin.reservas-index', compact('reservas', 'q'));
    }

    public function create()
    {
        $servicios = Servicio::all();
        return view('reservas.create', compact('servicios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date',
        ]);

        $data['user_id'] = Auth::id();

        Reserva::create($data);
        return redirect()->route('reservas.index')->with('success','Reserva creada.');
    }

    public function edit(Reserva $reserva)
    {
        $servicios = Servicio::all();
        return view('reservas.edit', compact('reserva','servicios'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $data = $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ✅ Solo admin puede cambiar el user_id, usuarios regulares mantienen su ID
        if ($user->hasRole('admin')) {
            $data['user_id'] = $request->input('user_id', $reserva->user_id);
        } else {
            $data['user_id'] = $user->id;
        }

        $reserva->update($data);
        return redirect()->route('reservas.index')->with('success','Reserva actualizada.');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success','Reserva eliminada.');
    }
}