<?php
namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with('servicio')->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $servicios = Servicio::all();
        return view('reservas.create', compact('servicios'));
    }
    // modificado store :v
    public function store(Request $request)
    {
        $data = $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date',
        ]);

        $data['cliente'] = auth()->user()->name;

        // 🔹 Verificar si ya existe una reserva en ese servicio y fecha
        $existe = Reserva::where('servicio_id', $data['servicio_id'])
                        ->where('fecha', $data['fecha'])
                        ->exists();

        if ($existe) {
            return back()->withErrors(['fecha' => 'Ya existe una reserva para este servicio en esa fecha.']);
        }

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
            'cliente' => 'required|string|max:100',
            'fecha' => 'required|date',
        ]);

        $reserva->update($data);
        return redirect()->route('reservas.index')->with('success','Reserva actualizada.');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success','Reserva eliminada.');
    }
}
