<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;
use App\Models\Evento;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventos = Evento::all();

        $equipos = [
            [
                'nombre_equipo' => 'Los Sabores del Norte',
                'evento_id' => $eventos->first()->id,
                'entidad_federativa' => 'Nuevo León',
                'estatus_del_equipo' => 'activo',
                'nombre_anfitrion' => 'María González',
                'telefono_anfitrion' => '8181234567',
                'correo_anfitrion' => 'maria.gonzalez@email.com'
            ],
            [
                'nombre_equipo' => 'Cocineros del Centro',
                'evento_id' => $eventos->first()->id,
                'entidad_federativa' => 'Ciudad de México',
                'estatus_del_equipo' => 'activo',
                'nombre_anfitrion' => 'Carlos Rodríguez',
                'telefono_anfitrion' => '5512345678',
                'correo_anfitrion' => 'carlos.rodriguez@email.com'
            ],
            [
                'nombre_equipo' => 'Gastrónomos del Sur',
                'evento_id' => $eventos->get(1)->id,
                'entidad_federativa' => 'Oaxaca',
                'estatus_del_equipo' => 'activo',
                'nombre_anfitrion' => 'Ana Martínez',
                'telefono_anfitrion' => '9512345678',
                'correo_anfitrion' => 'ana.martinez@email.com'
            ]
        ];

        foreach ($equipos as $equipo) {
            Equipo::create($equipo);
        }
    }
} 