<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nueva Reserva
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">Nueva Reserva</h1>
                        <a href="{{ route('reservas.index') }}" class="text-gray-600 hover:text-gray-900">
                            ← Regresar
                        </a>
                    </div>

                    <form action="{{ route('reservas.store') }}" method="POST">
                        @csrf

                        <!-- Usuario -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Usuario</label>
                            <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-4">
                            <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                            <input type="date" name="fecha" id="fecha" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('fecha')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Servicio -->
                        <div class="mb-6">
                            <label for="servicio_id" class="block text-sm font-medium text-gray-700 mb-2">Servicio</label>
                            <select name="servicio_id" id="servicio_id" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Seleccione un servicio</option>
                                @foreach($servicios as $servicio)
                                    <option value="{{ $servicio->id }}" data-descripcion="{{ $servicio->descripcion ?? 'Sin descripción' }}">
                                        {{ $servicio->nombre }} - {{ $servicio->horario }}
                                    </option>
                                @endforeach
                            </select>
                            @error('servicio_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción del servicio (solo lectura) -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción del Servicio</label>
                            <div id="descripcion-servicio" class="text-gray-600 italic">
                                Seleccione un servicio para ver su descripción...
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-medium">
                            Crear Reserva
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mostrar descripción del servicio seleccionado
        document.getElementById('servicio_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const descripcion = selectedOption.getAttribute('data-descripcion');
            const descripcionDiv = document.getElementById('descripcion-servicio');
            
            if (this.value) {
                descripcionDiv.textContent = descripcion;
                descripcionDiv.classList.remove('italic', 'text-gray-600');
                descripcionDiv.classList.add('text-gray-900');
            } else {
                descripcionDiv.textContent = 'Seleccione un servicio para ver su descripción...';
                descripcionDiv.classList.add('italic', 'text-gray-600');
                descripcionDiv.classList.remove('text-gray-900');
            }
        });
    </script>
</x-app-layout>