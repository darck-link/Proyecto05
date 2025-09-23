<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reservas</h2>
    </x-slot>

    <div class="py-6 px-4">
        <a href="{{ route('reservas.create') }}" 
           class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            + Nueva Reserva
        </a>

        <div class="mt-6 overflow-x-auto">
            <table class="w-full table-auto border border-gray-300 rounded-lg text-left shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">Cliente</th>
                        <th class="px-4 py-2 border-b">Fecha</th>
                        <th class="px-4 py-2 border-b">Servicio</th>
                        <th class="px-4 py-2 border-b">Imagen</th>
                        <th class="px-4 py-2 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $r)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $r->cliente }}</td>
                            <td class="px-4 py-2">{{ $r->fecha }}</td>
                            <td class="px-4 py-2">{{ $r->servicio->nombre }}</td>
                            <td class="px-4 py-2">
                                @if($r->servicio->imagen)
                                    <img src="{{ asset('storage/'.$r->servicio->imagen) }}" 
                                         class="w-20 h-auto rounded">
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('reservas.edit',$r) }}" 
                                   class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    Editar
                                </a>
                                <form action="{{ route('reservas.destroy',$r) }}" method="POST" 
                                      class="inline-block" 
                                      onsubmit="return confirm('¿Eliminar esta reserva?');">
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
