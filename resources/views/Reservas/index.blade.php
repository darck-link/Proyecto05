<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @auth
                @if(auth()->user()->hasRole('admin'))
                    Gestión de Reservas (Admin)
                @else
                    Mis Reservas
                @endif
            @endauth
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">
                            @auth
                                @if(auth()->user()->hasRole('admin'))
                                    Todas las Reservas del Sistema
                                @else
                                    Mis Reservas
                                @endif
                            @endauth
                        </h1>
                        
                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                <a href="{{ route('servicios.index') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 mr-2">
                                    📋 Gestionar Servicios
                                </a>
                                <a href="{{ route('admin.dashboard') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 mr-2">
                                    🛠️ Panel Admin
                                </a>
                            @endif
                            
                            <a href="{{ route('reservas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                ➕ Nueva Reserva
                            </a>
                        @endauth
                    </div>

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
                                @forelse($reservas as $reserva)
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
                                @empty
                                <tr>
                                    <td colspan="@auth @if(auth()->user()->hasRole('admin')) 7 @else 6 @endif @endauth" class="px-6 py-4 text-center text-gray-500">
                                        No hay reservas registradas.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-6">
                        {{ $reservas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>