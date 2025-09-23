<x-app-layout>
    <x-slot name="header"><h2>Editar Reserva</h2></x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8" style="max-width: 400px;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Botón Regresar -->
                <a href="{{ route('reservas.index') }}" 
                   class="inline-block mb-6 text-gray-600 hover:text-gray-900 font-medium">
                    &larr; Regresar
                </a>

                <form action="{{ route('reservas.update', $reserva) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                        <input type="text" name="cliente" value="{{ old('cliente', $reserva->cliente) }}" required class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" name="fecha" value="{{ old('fecha', $reserva->fecha) }}" required class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                        <select name="servicio_id" required class="w-full border border-gray-300 rounded-md px-3 py-2">
                            @foreach($servicios as $s)
                                <option value="{{ $s->id }}" {{ $s->id == $reserva->servicio_id ? 'selected' : '' }}>
                                    {{ $s->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button class="bg-blue-500 w-full text-white font-bold py-3 px-6 rounded-md">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
