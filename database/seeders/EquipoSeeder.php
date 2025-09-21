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
        $evento = Evento::first();

        // Equipos para usuarios de prueba
        $equipos = [
            [
                'nombre_equipo' => 'Equipo Prueba 1',
                'evento_id' => $evento->id,
                'entidad_federativa' => 'Ciudad de México',
                'estatus_del_equipo' => 'activo',
                'nombre_anfitrion' => 'Usuario Prueba 1',
                'telefono_anfitrion' => '5512345678',
                'correo_anfitrion' => 'prueba1@cecyte.com'
            ],
            [
                'nombre_equipo' => 'Equipo Prueba 2',
                'evento_id' => $evento->id,
                'entidad_federativa' => 'Jalisco',
                'estatus_del_equipo' => 'activo',
                'nombre_anfitrion' => 'Usuario Prueba 2',
                'telefono_anfitrion' => '3312345678',
                'correo_anfitrion' => 'prueba2@cecyte.com'
            ]
        ];

        // Estados de México
        $estados = [
            'Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 
            'Chiapas', 'Chihuahua', 'Ciudad de México', 'Coahuila', 'Colima', 
            'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'México', 
            'Michoacán', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 
            'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 
            'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz', 'Yucatán', 'Zacatecas'
        ];

        // Crear equipos para cada estado
        foreach ($estados as $estado) {
            $equipos[] = [
                'nombre_equipo' => 'Equipo ' . $estado,
                'evento_id' => $evento->id,
                'entidad_federativa' => $estado,
                'estatus_del_equipo' => 'activo',
                'nombre_anfitrion' => 'Representante ' . $estado,
                'telefono_anfitrion' => '5551234567',
                'correo_anfitrion' => strtolower(str_replace(' ', '', $estado)) . '@cecyte.com'
            ];
        }

        foreach ($equipos as $equipo) {
            Equipo::create($equipo);
        }
    }
} 