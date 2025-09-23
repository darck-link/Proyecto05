<x-app-layout>
    <x-slot name="header"><h2>Nuevo Servicio</h2></x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8" style="max-width: 500px;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <a href="{{ route('servicios.index') }}" 
                   class="inline-block mb-6 text-gray-600 hover:text-gray-900 font-medium">
                    &larr; Volver
                </a>

                <form action="{{ route('servicios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre" required 
                               class="w-full border px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" class="w-full border px-3 py-2 rounded-md"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horario</label>
                        <input type="text" name="horario" required 
                               class="w-full border px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                        <input type="file" name="imagen" class="w-full border px-3 py-2 rounded-md">
                    </div>
                    <button class="bg-green-600 hover:bg-green-700 w-full text-white font-bold py-2 px-4 rounded">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
