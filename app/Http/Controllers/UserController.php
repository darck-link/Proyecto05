<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function asignarRol($id, $rol)
    {
        // 1. Buscar usuario por ID
        $user = User::findOrFail($id);

        // 2. Asignarle el rol
        $user->assignRole($rol);

        // 3. Devolver respuesta
        return "El usuario {$user->name} ahora tiene el rol {$rol}";
    }
}
