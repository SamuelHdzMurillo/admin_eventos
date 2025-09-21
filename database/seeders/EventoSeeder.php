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
        // Crear solo el evento CECYTE Chef Nacional 2025
        Evento::create([
            'nombre_evento' => 'CECYTE Chef Nacional 2025',
            'inicio_evento' => Carbon::parse('2025-06-15 09:00:00'),
            'fin_evento' => Carbon::parse('2025-06-17 18:00:00'),
            'sede_evento' => 'Centro de Convenciones CDMX',
            'lim_de_participantes_evento' => 200,
            'estatus_evento' => 'activo'
        ]);
    }
} 