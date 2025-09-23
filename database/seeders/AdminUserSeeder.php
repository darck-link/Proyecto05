<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el rol admin si no existe
        Role::firstOrCreate(['name' => 'admin']);

        // Crear usuario de prueba si no existe
        $user = User::where('email', 'admin@123')->first();
        if (!$user) {
            $user = User::create([
                'name' => 'Administrador',
                'email' => 'admin@123',
                'password' => Hash::make('12345678'), // contraseña segura
            ]);
        }

        // Asignar rol admin
        $user->assignRole('admin');
    }
}
