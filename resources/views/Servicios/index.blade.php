<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-4">
            <!-- Menú de Navegación -->
            <div class="flex flex-wrap gap-3 pb-4 border-b border-gray-200">
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition duration-200 
                          {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 border border-blue-200 shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                
                @auth
                    @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('servicios.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition duration-200 
                              {{ request()->routeIs('servicios.*') ? 'bg-green-100 text-green-700 border border-green-200 shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Gestión de Servicios
                    </a>
                    @endif
                    
                    <a href="{{ route('reservas.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition duration-200 
                              {{ request()->routeIs('reservas.*') ? 'bg-purple-100 text-purple-700 border border-purple-200 shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Gestión de Reservas
                    </a>
                @endauth
            </div>
            
            <!-- Título y acciones de la página -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="font-semibold text-xl text-gray-900 leading-tight">Gestión de Servicios</h2>
                    <p class="text-sm text-gray-600 mt-1">Administra los servicios disponibles en el sistema</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <form method="GET" action="{{ route('servicios.index') }}" class="flex">
                        <input type="search" name="q" value="{{ $q ?? '' }}" placeholder="Buscar servicios..." 
                               class="border border-gray-300 rounded-l-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none w-full sm:w-48">
                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-r-lg text-sm transition duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Buscar
                        </button>
                    </form>

                    <a href="{{ route('servicios.create') }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm flex items-center justify-center gap-2 whitespace-nowrap transition duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Nuevo Servicio
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4">
        <!-- Alertas -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Estadísticas Rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Servicios</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $servicios->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="bg-green-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Con Imagen</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $servicios->whereNotNull('imagen')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Horarios Únicos</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $servicios->pluck('horario')->unique()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Servicios -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-700 uppercase">
                        <tr>
                            <th class="px-6 py-4 font-medium text-xs">ID</th>
                            <th class="px-6 py-4 font-medium text-xs">Nombre</th>
                            <th class="px-6 py-4 font-medium text-xs">Descripción</th>
                            <th class="px-6 py-4 font-medium text-xs">Horario</th>
                            <th class="px-6 py-4 font-medium text-xs">Imagen</th>
                            <th class="px-6 py-4 font-medium text-xs text-center">Reservas</th>
                            <th class="px-6 py-4 font-medium text-xs text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($servicios as $servicio)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-gray-600 text-xs">#{{ $servicio->id }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $servicio->nombre }}</p>
                                        <p class="text-xs text-gray-500">Creado: {{ $servicio->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    @if($servicio->descripcion)
                                        <p class="text-gray-700 text-sm truncate" title="{{ $servicio->descripcion }}">
                                            {{ Str::limit($servicio->descripcion, 50) }}
                                        </p>
                                    @else
                                        <span class="text-gray-400 text-xs">Sin descripción</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full whitespace-nowrap">
                                        {{ $servicio->horario }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($servicio->imagen)
                                        <img src="{{ asset('storage/'.$servicio->imagen) }}" alt="Imagen" 
                                             class="w-16 h-12 object-cover rounded-lg border shadow-sm">
                                    @else
                                        <span class="text-gray-400 text-xs">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full">
                                        {{ $servicio->reservas->count() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2 justify-center">
                                        <a href="{{ route('servicios.edit', $servicio) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-xs flex items-center gap-1 transition duration-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Editar
                                        </a>
                                        <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" 
                                              onsubmit="return confirm('¿Estás seguro de eliminar este servicio?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-xs flex items-center gap-1 transition duration-200">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <p class="font-medium text-lg mb-2">No hay servicios registrados</p>
                                        <p class="text-sm mb-4">Comienza agregando tu primer servicio al sistema</p>
                                        <a href="{{ route('servicios.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm transition duration-200">
                                            Crear Primer Servicio
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="text-sm text-gray-600">
                Mostrando {{ $servicios->firstItem() ?? 0 }} - {{ $servicios->lastItem() ?? 0 }} de {{ $servicios->total() }} servicios
            </div>
            <div>
                {{ $servicios->links() }}
            </div>
        </div>
    </div>
</x-app-layout>