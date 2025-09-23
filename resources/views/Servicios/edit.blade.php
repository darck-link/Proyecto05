<x-app-layout>
    <x-slot name="header"><h2>Editar Servicio</h2></x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8" style="max-width: 500px;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Botón Regresar -->
                <a href="{{ route('servicios.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded shadow inline-block mb-6">
                    ← Regresar
                </a>

                <form action="{{ route('servicios.update',$servicio) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre" value="{{ $servicio->nombre }}" required
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" 
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">{{ $servicio->descripcion }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horario</label>
                        <input type="text" name="horario" value="{{ $servicio->horario }}" required
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                        <input type="file" name="imagen" 
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                        @if($servicio->imagen)
                            <img src="{{ asset('storage/'.$servicio->imagen) }}" alt="Imagen actual" class="mt-2 w-32 h-24 object-cover rounded">
                        @endif
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
