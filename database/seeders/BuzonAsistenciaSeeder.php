<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BuzonAsistencia;
use App\Models\Evento;
use App\Models\Equipo;

class BuzonAsistenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evento = Evento::first();
        $equipo = Equipo::first();

        if ($evento && $equipo) {
            // Solo un mensaje de ejemplo
            BuzonAsistencia::create([
                'evento_id' => $evento->id,
                'equipo_id' => $equipo->id,
                'correo_electronico' => 'juan.perez@cecyte.com',
                'telefono' => '+52 55 1234 5678',
                'mensaje' => 'Hola, tengo una pregunta sobre el horario del evento. ¿Podrían confirmarme si el evento comienza a las 9:00 AM?',
                'estado' => 'pendiente',
                'atendido' => false,
            ]);
        }
    }
}
