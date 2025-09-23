<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        $servicios = [
            [
                'nombre' => 'Asesorías',
                'descripcion' => 'Consultas personalizadas con expertos.',
                'horario' => 'Lunes a Viernes 9:00 - 18:00',
            ],
            [
                'nombre' => 'Mantenimiento Técnico',
                'descripcion' => 'Soporte y reparación de equipos.',
                'horario' => 'Lunes a Sábado 10:00 - 17:00',
            ],
            [
                'nombre' => 'Consultorías Especializadas',
                'descripcion' => 'Orientación avanzada en proyectos específicos.',
                'horario' => 'Martes y Jueves 14:00 - 20:00',
            ],
        ];

        foreach ($servicios as $s) {
            Servicio::firstOrCreate(['nombre' => $s['nombre']], $s);
        }
    }
}
