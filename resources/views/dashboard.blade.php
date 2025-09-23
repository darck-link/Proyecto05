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
            
            <!-- Título del Dashboard -->
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    🏠 Dashboard Principal
                </h2>
                <p class="text-sm text-gray-600 mt-1">Bienvenido al sistema de gestión de reservas</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Resto de tu contenido del dashboard -->
            @role('admin')
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-green-800 mb-2">👑 Eres Administrador</h3>
                <p class="text-green-700">Tienes acceso completo al sistema:</p>
                <ul class="list-disc list-inside text-green-600 mt-2">
                    <li>Gestión de servicios</li>
                    <li>Ver todas las reservas</li>
                    <li>Gestión de usuarios</li>
                </ul>
                <div class="mt-4 flex space-x-4">
                    <a href="{{ route('servicios.index') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        📋 Gestionar Servicios
                    </a>
                    <a href="{{ route('reservas.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        📅 Ver Reservas
                    </a>
                </div>
            </div>
            @else
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">👤 Eres Usuario</h3>
                <p class="text-blue-700">Puedes gestionar tus propias reservas:</p>
                <div class="mt-4">
                    <a href="{{ route('reservas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        ➕ Nueva Reserva
                    </a>
                </div>
            </div>
            @endrole

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">¡Bienvenido, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-600">Sistema de Gestión de Reservas - Servicios Premium S.A.</p>
                
                @role('admin')
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-4 rounded">
                        <h4 class="font-semibold">Usuarios Registrados</h4>
                        <p class="text-2xl">{{ \App\Models\User::count() }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <h4 class="font-semibold">Total Reservas</h4>
                        <p class="text-2xl">{{ \App\Models\Reserva::count() }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <h4 class="font-semibold">Servicios Activos</h4>
                        <p class="text-2xl">{{ \App\Models\Servicio::count() }}</p>
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>