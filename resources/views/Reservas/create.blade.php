<x-app-layout>
    <x-slot name="header"><h2>Nueva Reserva</h2></x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8" style="max-width: 500px;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <a href="{{ route('reservas.index') }}" 
                   class="inline-block mb-6 text-gray-600 hover:text-gray-900 font-medium">
                    &larr; Volver
                </a>

                <form action="{{ route('reservas.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                        <input type="text" name="cliente" required 
                               class="w-full border px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" name="fecha" required 
                               class="w-full border px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                        <select name="servicio_id" required class="w-full border px-3 py-2 rounded-md">
                            <option value="">Seleccione un servicio</option>
                            @foreach($servicios as $s)
                                <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="bg-green-600 hover:bg-green-700 w-full text-white font-bold py-2 px-4 rounded">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
