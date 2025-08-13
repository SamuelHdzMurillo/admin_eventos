<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Acompanante;
use App\Models\Equipo;

class AcompananteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipos = Equipo::all();

        $acompanantes = [
            [
                'equipo_id' => $equipos->first()->id,
                'nombre_acompanante' => 'Dr. Roberto Silva',
                'rol' => 'Asesor Académico',
                'puesto' => 'Profesor Titular',
                'talla' => 'L',
                'telefono' => '8183333333',
                'email' => 'roberto.silva@email.com'
            ],
            [
                'equipo_id' => $equipos->first()->id,
                'nombre_acompanante' => 'Lic. Patricia Morales',
                'rol' => 'Coordinadora',
                'puesto' => 'Coordinadora de Eventos',
                'talla' => 'M',
                'telefono' => '8184444444',
                'email' => 'patricia.morales@email.com'
            ]
        ];

        foreach ($acompanantes as $acompanante) {
            Acompanante::create($acompanante);
        }
    }
} 