<x-app-layout>
    <x-slot name="header"><h2>Editar Servicio</h2></x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8" style="max-width: 400px;">            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Botón Regresar -->
                <a href="{{ route('servicios.index') }}" 
                   class="inline-block mb-6 text-gray-600 hover:text-gray-900 font-medium">
                    &larr; Regresar
                </a>

                <form action="{{ route('servicios.update', $servicio) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $servicio->nombre) }}" required class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" class="w-full border border-gray-300 rounded-md px-3 py-2">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                    </div>

                    <div>
                        <label for="horario" class="block text-sm font-medium text-gray-700 mb-1">Horario</label>
                        <input type="text" name="horario" value="{{ old('horario', $servicio->horario) }}" required class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>

                    <div>
                        <label for="imagen" class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                        @if($servicio->imagen)
                            <img src="{{ asset('storage/'.$servicio->imagen) }}" width="120" class="mb-2">
                        @endif
                        <input type="file" name="imagen" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>

                    <button class="bg-blue-500 w-full text-white font-bold py-3 px-6 rounded-md">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
