<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

use App\Models\User;

class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear los roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'editor']);

        // 2. Buscar un usuario existente (o crearlo)
        $user = User::where('email', 'admin@example.com')->first();
        if (!$user) {
            $user = User::create([
                'name'     => 'Administrador',
                'email'    => 'admin@example.com',
                'password' => bcrypt('secret'),
            ]);
        }

        // 3. Asignar el rol
        $user->assignRole('admin');

    }
}
