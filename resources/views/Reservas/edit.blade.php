<x-app-layout>
    <x-slot name="header"><h2>Editar Reserva</h2></x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8" style="max-width: 500px;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Botón Regresar -->
                <a href="{{ route('reservas.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded shadow inline-block mb-6">
                    ← Regresar
                </a>

                <form action="{{ route('reservas.update',$reserva) }}" method="POST" class="space-y-6">
                    @csrf @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                        <input type="text" name="cliente" value="{{ $reserva->cliente }}" required
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" name="fecha" value="{{ $reserva->fecha }}" required
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                        <select name="servicio_id" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                            @foreach($servicios as $s)
                                <option value="{{ $s->id }}" @if($s->id == $reserva->servicio_id) selected @endif>
                                    {{ $s->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded shadow w-full">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
