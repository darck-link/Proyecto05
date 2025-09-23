<x-app-layout>
    <x-slot name="header"><h2>Nueva Reserva</h2></x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8" style="max-width: 500px;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Botón Regresar -->
                <a href="{{ route('reservas.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded shadow inline-block mb-6">
                    ← Regresar
                </a>

                <!-- AÑADIR enctype PARA ARCHIVOS -->
                <form action="{{ route('reservas.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
                        <input type="text" value="{{ Auth::user()->email }}" readonly
                            style="background-color: #f3f4f6; color:#374151; padding:8px; border-radius:6px; width:100%;">
                    </div>

                    <div>
                        <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" name="fecha" required
                            style="padding:8px; border:1px solid #d1d5db; border-radius:6px; width:100%;">
                    </div>

                    <div>
                        <label for="servicio_id" class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                        <select name="servicio_id" required
                                style="padding:8px; border:1px solid #d1d5db; border-radius:6px; width:100%;">
                            <option value="">Seleccione un servicio</option>
                            @foreach($servicios as $s)
                                <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- NUEVO CAMPO OPCIONAL PARA IMAGEN -->
                    <div>
                        <label for="imagen" class="block text-sm font-medium text-gray-700 mb-1">Detalles adicionales (opcional)</label>
                        <input type="file" name="imagen" accept="image/*"
                               style="padding:6px; border:1px solid #d1d5db; border-radius:6px; width:100%;">
                    </div>

                    <button type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow w-full">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
