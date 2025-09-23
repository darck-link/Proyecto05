<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Servicios</h2>
    </x-slot>

    <div class="py-6 px-4">
        <a href="{{ route('servicios.create') }}" 
           class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            + Nuevo Servicio
        </a>

        <div class="mt-6 overflow-x-auto">
            <table class="w-full table-auto border border-gray-300 rounded-lg text-left shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">Nombre</th>
                        <th class="px-4 py-2 border-b">Horario</th>
                        <th class="px-4 py-2 border-b">Imagen</th>
                        <th class="px-4 py-2 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $s)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $s->nombre }}</td>
                            <td class="px-4 py-2">{{ $s->horario }}</td>
                            <td class="px-4 py-2">
                                @if($s->imagen)
                                    <img src="{{ asset('storage/'.$s->imagen) }}" 
                                         alt="Imagen servicio" class="w-20 h-auto rounded">
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('servicios.edit',$s) }}" 
                                   class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    Editar
                                </a>
                                <form action="{{ route('servicios.destroy',$s) }}" method="POST" 
                                      class="inline-block" 
                                      onsubmit="return confirm('¿Eliminar este servicio?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
