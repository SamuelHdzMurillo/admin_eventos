<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CedulaRegistro;
use App\Models\Equipo;

class CedulaRegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipos = Equipo::all();

        $cedulas = [
            [
                'equipo_id' => $equipos->first()->id,
                'participantes' => [
                    'Juan Pérez - Chef Principal',
                    'Sofía López - Sous Chef'
                ],
                'asesores' => [
                    'Dr. Roberto Silva - Asesor Académico',
                    'Lic. Patricia Morales - Coordinadora'
                ],
                'estado' => 'aprobada'
            ],
            [
                'equipo_id' => $equipos->get(1)->id,
                'participantes' => [
                    'Carlos Rodríguez - Chef Principal'
                ],
                'asesores' => [
                    'Prof. Laura Fernández - Asesora'
                ],
                'estado' => 'pendiente'
            ]
        ];

        foreach ($cedulas as $cedula) {
            CedulaRegistro::create($cedula);
        }
    }
} 