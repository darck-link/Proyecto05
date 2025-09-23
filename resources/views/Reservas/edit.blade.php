<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Reserva
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">Editar Reserva</h1>
                        <a href="{{ route('reservas.index') }}" class="text-gray-600 hover:text-gray-900">
                            ← Regresar
                        </a>
                    </div>

                    <form action="{{ route('reservas.update', $reserva) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Usuario -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Usuario</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $reserva->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $reserva->user->email }}</p>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-4">
                            <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="{{ $reserva->fecha }}" required
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
                                    <option value="{{ $servicio->id }}" 
                                            data-descripcion="{{ $servicio->descripcion ?? 'Sin descripción' }}"
                                            {{ $reserva->servicio_id == $servicio->id ? 'selected' : '' }}>
                                        {{ $servicio->nombre }} - {{ $servicio->horario }}
                                    </option>
                                @endforeach
                            </select>
                            @error('servicio_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción del servicio -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción del Servicio</label>
                            <div id="descripcion-servicio" class="text-gray-900">
                                {{ $reserva->servicio->descripcion ?? 'Sin descripción' }}
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-medium">
                            Actualizar Reserva
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Actualizar descripción cuando cambie el servicio
        document.getElementById('servicio_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const descripcion = selectedOption.getAttribute('data-descripcion');
            const descripcionDiv = document.getElementById('descripcion-servicio');
            
            descripcionDiv.textContent = descripcion;
        });
    </script>
</x-app-layout>