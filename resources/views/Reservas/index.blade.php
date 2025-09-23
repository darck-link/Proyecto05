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
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                📅 Todas las Reservas
                            @else
                                📅 Mis Reservas
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
                            <a href="{{ route('servicios.index') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 mr-2">
                                📋 Gestionar Servicios
                            </a>
                        @endif
                        
                        <a href="{{ route('reservas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            ➕ Nueva Reserva
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4">
        <!-- Resto del contenido de reservas (mantén tu código actual) -->
        <!-- Buscador -->
        <form method="GET" action="{{ route('reservas.index') }}" class="mb-6">
            <div class="flex gap-2">
                <input type="text" name="q" value="{{ $q }}" 
                       placeholder="@auth @if(auth()->user()->hasRole('admin')) Buscar por cliente o servicio... @else Buscar por servicio... @endif @endauth" 
                       class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">
                    🔍 Buscar
                </button>
                @if($q)
                    <a href="{{ route('reservas.index') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                        🗑️ Limpiar
                    </a>
                @endif
            </div>
        </form>

        <!-- Tabla de Reservas -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                            @endif
                        @endauth
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Servicio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($reservas as $reserva)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reserva->id }}</td>
                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $reserva->user->name }}
                                    <br><span class="text-xs text-gray-500">{{ $reserva->user->email }}</span>
                                </td>
                            @endif
                        @endauth
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reserva->fecha }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reserva->servicio->nombre }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ Str::limit($reserva->servicio->descripcion, 50) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reserva->servicio->horario }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @auth
                                @if(auth()->user()->hasRole('admin') || $reserva->user_id == auth()->id())
                                    <a href="{{ route('reservas.edit', $reserva) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">✏️ Editar</a>
                                    <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" 
                                                onclick="return confirm('¿Estás seguro de eliminar esta reserva?')">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400">No disponible</span>
                                @endif
                            @endauth
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $reservas->links() }}
        </div>
    </div>
</x-app-layout>