<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-4">
            <!-- Menú de Navegación -->
            <div class="flex flex-wrap gap-2 pb-4 border-b border-gray-200">
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition duration-150 
                          {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 border border-blue-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    🏠 Dashboard
                </a>
                
                @auth
                    @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('servicios.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition duration-150 
                              {{ request()->routeIs('servicios.*') ? 'bg-green-100 text-green-700 border border-green-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        📋 Gestión de Servicios
                    </a>
                    @endif
                    
                    <a href="{{ route('reservas.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition duration-150 
                              {{ request()->routeIs('reservas.*') ? 'bg-purple-100 text-purple-700 border border-purple-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        📅 Gestión de Reservas
                    </a>
                @endauth
            </div>
            
            <!-- Título y acciones de la página -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">📋 Servicios</h2>
                    <p class="text-sm text-gray-600 mt-1">Gestión de servicios disponibles</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <form method="GET" action="{{ route('servicios.index') }}" class="flex">
                        <input type="search" name="q" value="{{ $q ?? '' }}" placeholder="Buscar..." 
                               class="border border-gray-300 rounded-l px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none w-full sm:w-48">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-r text-sm">
                            🔍 Buscar
                        </button>
                    </form>

                    <a href="{{ route('servicios.create') }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow text-sm flex items-center justify-center gap-2 whitespace-nowrap">
                        ➕ Nuevo Servicio
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4">
        <!-- Alertas -->
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded flex items-center gap-3">
                <span class="text-green-600">✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Estadísticas Rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow border">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <span class="text-blue-600 text-lg">📊</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Servicios</p>
                        <p class="text-xl font-bold text-gray-900">{{ $servicios->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow border">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <span class="text-green-600 text-lg">🖼️</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Con Imagen</p>
                        <p class="text-xl font-bold text-gray-900">{{ $servicios->whereNotNull('imagen')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow border">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <span class="text-purple-600 text-lg">⏰</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Horarios Únicos</p>
                        <p class="text-xl font-bold text-gray-900">{{ $servicios->pluck('horario')->unique()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Servicios -->
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b font-medium">#</th>
                        <th class="px-4 py-3 border-b font-medium">Nombre</th>
                        <th class="px-4 py-3 border-b font-medium">Descripción</th>
                        <th class="px-4 py-3 border-b font-medium">Horario</th>
                        <th class="px-4 py-3 border-b font-medium">Imagen</th>
                        <th class="px-4 py-3 border-b font-medium text-center">Reservas</th>
                        <th class="px-4 py-3 border-b font-medium text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servicios as $s)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="px-4 py-3 align-top">
                                <span class="font-mono text-gray-600">#{{ $s->id }}</span>
                            </td>
                            <td class="px-4 py-3 align-top">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $s->nombre }}</p>
                                    <p class="text-xs text-gray-500">Creado: {{ $s->created_at->format('d/m/Y') }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 align-top max-w-xs">
                                @if($s->descripcion)
                                    <p class="text-gray-700 text-sm truncate" title="{{ $s->descripcion }}">
                                        {{ Str::limit($s->descripcion, 50) }}
                                    </p>
                                @else
                                    <span class="text-gray-400 text-xs">Sin descripción</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 align-top">
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full whitespace-nowrap">
                                    {{ $s->horario }}
                                </span>
                            </td>
                            <td class="px-4 py-3 align-top">
                                @if($s->imagen)
                                    <img src="{{ asset('storage/'.$s->imagen) }}" alt="Imagen" 
                                         class="w-16 h-12 object-cover rounded border">
                                @else
                                    <span class="text-gray-400 text-xs">🖼️ Sin imagen</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 align-top text-center">
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">
                                    {{ $s->reservas->count() }}
                                </span>
                            </td>
                            <td class="px-4 py-3 align-top text-center">
                                <div class="flex flex-col sm:flex-row gap-1 justify-center">
                                    <a href="{{ route('servicios.edit', $s) }}" 
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-xs flex items-center gap-1 justify-center transition duration-150">
                                        ✏️ Editar
                                    </a>
                                    <form action="{{ route('servicios.destroy', $s) }}" method="POST" 
                                          onsubmit="return confirm('¿Estás seguro de eliminar este servicio?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-xs flex items-center gap-1 justify-center transition duration-150 w-full">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center">
                                <div class="text-gray-500">
                                    <div class="text-4xl mb-2">📋</div>
                                    <p class="font-medium">No hay servicios registrados</p>
                                    <p class="text-sm mt-1">Comienza agregando tu primer servicio</p>
                                    <a href="{{ route('servicios.create') }}" class="inline-block mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                                        ➕ Crear Primer Servicio
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="text-sm text-gray-600">
                Mostrando {{ $servicios->firstItem() ?? 0 }} - {{ $servicios->lastItem() ?? 0 }} de {{ $servicios->total() }} servicios
            </div>
            <div>
                {{ $servicios->links() }}
            </div>
        </div>
    </div>
</x-app-layout>