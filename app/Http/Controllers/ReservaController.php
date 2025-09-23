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

        $query = Reserva::with('servicio');

        if ($q) {
            $query->where('cliente', 'like', "%{$q}%")
                  ->orWhereHas('servicio', function($sub) use ($q) {
                      $sub->where('nombre', 'like', "%{$q}%");
                  });
        }

        $reservas = $query->orderBy('fecha', 'desc')->paginate(10)->withQueryString();

        return view('reservas.index', compact('reservas', 'q'));
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // <-- agregado
        ]);

        $data['user_id'] = Auth::id(); // Guardar el usuario autenticado

        // Guardar la imagen si existe
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('reservas', 'public');
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
            'fecha' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // <-- agregado
        ]);

        $data['user_id'] = Auth::id(); // Mantener el usuario autenticado

        // Guardar la imagen si existe
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('reservas', 'public');
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
