<x-app-layout>
    <x-slot name="header"><h2>Nuevo Servicio</h2></x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8" style="max-width: 500px;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Botón Regresar -->
                <a href="{{ route('servicios.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded shadow inline-block mb-6">
                    ← Regresar
                </a>

                <form action="{{ route('servicios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre" required placeholder="Nombre del servicio"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" placeholder="Descripción" 
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horario</label>
                        <input type="text" name="horario" required placeholder="Horario"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                        <input type="file" name="imagen" 
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-500">
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
