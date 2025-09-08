<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comite;
use App\Models\Evento;

class ComiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el primer evento para asociar los comités
        $evento = Evento::first();
        
        if ($evento) {
            $comites = [
                [
                    'evento_id' => $evento->id,
                    'nombre' => 'Dr. Juan Pérez',
                    'rol' => 'Presidente',
                    'puesto' => 'Director General',
                    'telefono' => '555-1234',
                    'extension' => '101'
                ],
                [
                    'evento_id' => $evento->id,
                    'nombre' => 'Dra. María García',
                    'rol' => 'Vicepresidente',
                    'puesto' => 'Subdirectora',
                    'telefono' => '555-5678',
                    'extension' => '102'
                ],
                [
                    'evento_id' => $evento->id,
                    'nombre' => 'Lic. Carlos López',
                    'rol' => 'Secretario',
                    'puesto' => 'Coordinador de Eventos',
                    'telefono' => '555-9012',
                    'extension' => '103'
                ],
                [
                    'evento_id' => $evento->id,
                    'nombre' => 'Ing. Ana Martínez',
                    'rol' => 'Tesorero',
                    'puesto' => 'Administradora',
                    'telefono' => '555-3456',
                    'extension' => '104'
                ],
                [
                    'evento_id' => $evento->id,
                    'nombre' => 'Prof. Roberto Silva',
                    'rol' => 'Coordinador Técnico',
                    'puesto' => 'Especialista en Logística',
                    'telefono' => '555-7890',
                    'extension' => '105'
                ]
            ];

            foreach ($comites as $comite) {
                Comite::create($comite);
            }
        }
    }
}
