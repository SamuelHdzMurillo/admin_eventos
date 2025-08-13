<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evento;
use Carbon\Carbon;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventos = [
            [
                'nombre_evento' => 'Concurso Nacional de Gastronomía 2024',
                'inicio_evento' => Carbon::parse('2024-06-15 09:00:00'),
                'fin_evento' => Carbon::parse('2024-06-17 18:00:00'),
                'sede_evento' => 'Centro de Convenciones CDMX',
                'lim_de_participantes_evento' => 200,
                'estatus_evento' => 'activo'
            ],
            [
                'nombre_evento' => 'Festival Culinario Regional Norte',
                'inicio_evento' => Carbon::parse('2024-07-20 08:00:00'),
                'fin_evento' => Carbon::parse('2024-07-22 17:00:00'),
                'sede_evento' => 'Auditorio Monterrey',
                'lim_de_participantes_evento' => 150,
                'estatus_evento' => 'activo'
            ],
            [
                'nombre_evento' => 'Competencia de Cocina Tradicional',
                'inicio_evento' => Carbon::parse('2024-08-10 10:00:00'),
                'fin_evento' => Carbon::parse('2024-08-12 19:00:00'),
                'sede_evento' => 'Palacio de la Gastronomía Guadalajara',
                'lim_de_participantes_evento' => 120,
                'estatus_evento' => 'activo'
            ]
        ];

        foreach ($eventos as $evento) {
            Evento::create($evento);
        }
    }
} 