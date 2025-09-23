<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1>¡Bienvenido!</h1>

        @role('admin')
            <p>Como administrador tienes acceso a la gestión de usuarios.</p>
        @endrole

        @role('editor')
            <p>Eres editor, puedes crear artículos.</p>
        @endrole
    </div>
</x-app-layout>
