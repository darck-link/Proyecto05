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
                    <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                Todas las Reservas
                            @else
                                Mis Reservas
                            @endif
                        @endauth
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">
                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                Gestión completa de reservas del sistema
                            @else
                                Gestiona tus reservas personales
                            @endif
                        @endauth
                    </p>
                </div>

                <div class="flex gap-3">
                    @auth
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('servicios.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Gestionar Servicios
                            </a>
                        @endif
                        
                        <a href="{{ route('reservas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Nueva Reserva
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4">
        <!-- Buscador -->
        <form method="GET" action="{{ route('reservas.index') }}" class="mb-6">
            <div class="flex gap-2">
                <input type="text" name="q" value="{{ $q }}" 
                       placeholder="@auth @if(auth()->user()->hasRole('admin')) Buscar por cliente o servicio... @else Buscar por servicio... @endif @endauth" 
                       class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg text-sm flex items-center gap-2 transition duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Buscar
                </button>
                @if($q)
                    <a href="{{ route('reservas.index') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg text-sm flex items-center gap-2 transition duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Limpiar
                    </a>
                @endif
            </div>
        </form>

        <!-- Tabla de Reservas -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-700 uppercase">
                        <tr>
                            <th class="px-6 py-4 font-medium text-xs">ID</th>
                            @auth
                                @if(auth()->user()->hasRole('admin'))
                                    <th class="px-6 py-4 font-medium text-xs">Cliente</th>
                                @endif
                            @endauth
                            <th class="px-6 py-4 font-medium text-xs">Fecha</th>
                            <th class="px-6 py-4 font-medium text-xs">Servicio</th>
                            <th class="px-6 py-4 font-medium text-xs">Descripción</th>
                            <th class="px-6 py-4 font-medium text-xs">Horario</th>
                            <th class="px-6 py-4 font-medium text-xs text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($reservas as $reserva)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">
                                <span class="font-mono text-gray-600 text-xs">#{{ $reserva->id }}</span>
                            </td>
                            @auth
                                @if(auth()->user()->hasRole('admin'))
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $reserva->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $reserva->user->email }}</p>
                                        </div>
                                    </td>
                                @endif
                            @endauth
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">
                                    {{ $reserva->fecha }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $reserva->servicio->nombre }}</p>
                            </td>
                            <td class="px-6 py-4 max-w-xs">
                                <p class="text-gray-700 text-sm truncate" title="{{ $reserva->servicio->descripcion }}">
                                    {{ Str::limit($reserva->servicio->descripcion, 50) }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-gray-600 text-sm">{{ $reserva->servicio->horario }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2 justify-center">
                                    @auth
                                        @if(auth()->user()->hasRole('admin') || $reserva->user_id == auth()->id())
                                            <a href="{{ route('reservas.edit', $reserva) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-xs flex items-center gap-1 transition duration-200">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Editar
                                            </a>
                                            <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar esta reserva?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-xs flex items-center gap-1 transition duration-200">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-xs">No disponible</span>
                                        @endif
                                    @endauth
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="text-sm text-gray-600">
                Mostrando {{ $reservas->firstItem() ?? 0 }} - {{ $reservas->lastItem() ?? 0 }} de {{ $reservas->total() }} reservas
            </div>
            <div>
                {{ $reservas->links() }}
            </div>
        </div>
    </div>
</x-app-layout>