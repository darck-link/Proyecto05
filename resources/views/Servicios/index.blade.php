<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Servicios</h2>

            <div class="flex items-center space-x-3">
                <form method="GET" action="{{ route('servicios.index') }}" class="flex items-center">
                    <input type="search" name="q" value="{{ $q ?? '' }}" placeholder="Buscar..." 
                           class="border rounded-l px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-r text-sm">Buscar</button>
                </form>

                <a href="{{ route('servicios.create') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow text-sm">
                    + Nuevo
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">#</th>
                        <th class="px-4 py-3 border-b">Nombre</th>
                        <th class="px-4 py-3 border-b">Horario</th>
                        <th class="px-4 py-3 border-b">Imagen</th>
                        <th class="px-4 py-3 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servicios as $s)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 border-b align-top">{{ $s->id }}</td>
                            <td class="px-4 py-3 border-b font-medium align-top">{{ $s->nombre }}</td>
                            <td class="px-4 py-3 border-b align-top">{{ $s->horario }}</td>
                            <td class="px-4 py-3 border-b align-top">
                                @if($s->imagen)
                                    <img src="{{ asset('storage/'.$s->imagen) }}" alt="Imagen" class="w-20 h-16 object-cover rounded">
                                @else
                                    <span class="text-gray-400 text-sm">Sin imagen</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b text-center align-top space-x-2">
                                <a href="{{ route('servicios.edit', $s) }}" 
                                   class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                   Editar
                                </a>

                                <form action="{{ route('servicios.destroy', $s) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar servicio?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">No hay servicios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-between items-center">
            <div class="text-sm text-gray-600">
                Mostrando {{ $servicios->firstItem() ?? 0 }} - {{ $servicios->lastItem() ?? 0 }} de {{ $servicios->total() }} resultados
            </div>

            <div>
                {{ $servicios->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
