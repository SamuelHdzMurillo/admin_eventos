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
        // Obtener eventos y equipos existentes
        $eventos = Evento::all();
        $equipos = Equipo::all();

        if ($eventos->isEmpty()) {
            $this->command->warn('No hay eventos disponibles. Creando mensajes sin evento específico.');
            return;
        }

        $mensajes = [
            [
                'evento_id' => $eventos->random()->id,
                'equipo_id' => $equipos->isNotEmpty() ? $equipos->random()->id : null,
                'correo_electronico' => 'juan.perez@email.com',
                'telefono' => '+52 55 1234 5678',
                'mensaje' => 'Hola, tengo una pregunta sobre el horario del evento. ¿Podrían confirmarme si el evento comienza a las 9:00 AM?',
                'estado' => 'pendiente',
                'atendido' => false,
            ],
            [
                'evento_id' => $eventos->random()->id,
                'equipo_id' => $equipos->isNotEmpty() ? $equipos->random()->id : null,
                'correo_electronico' => 'maria.garcia@email.com',
                'telefono' => '+52 55 9876 5432',
                'mensaje' => 'Necesito ayuda con el registro de mi equipo. No puedo encontrar el formulario de inscripción.',
                'estado' => 'en_proceso',
                'atendido' => false,
            ],
            [
                'evento_id' => $eventos->random()->id,
                'equipo_id' => $equipos->isNotEmpty() ? $equipos->random()->id : null,
                'correo_electronico' => 'carlos.rodriguez@email.com',
                'telefono' => '+52 55 5555 1234',
                'mensaje' => '¿Hay estacionamiento disponible en el lugar del evento? ¿Cuál es el costo?',
                'estado' => 'resuelto',
                'atendido' => true,
            ],
            [
                'evento_id' => $eventos->random()->id,
                'equipo_id' => $equipos->isNotEmpty() ? $equipos->random()->id : null,
                'correo_electronico' => 'ana.martinez@email.com',
                'telefono' => '+52 55 4444 8888',
                'mensaje' => 'Mi equipo no puede asistir al evento. ¿Cómo puedo cancelar nuestra participación?',
                'estado' => 'cancelado',
                'atendido' => true,
            ],
            [
                'evento_id' => $eventos->random()->id,
                'equipo_id' => $equipos->isNotEmpty() ? $equipos->random()->id : null,
                'correo_electronico' => 'luis.hernandez@email.com',
                'telefono' => '+52 55 7777 9999',
                'mensaje' => '¿Habrá comida incluida en el evento? Tengo restricciones alimentarias.',
                'estado' => 'pendiente',
                'atendido' => false,
            ],
            [
                'evento_id' => $eventos->random()->id,
                'equipo_id' => $equipos->isNotEmpty() ? $equipos->random()->id : null,
                'correo_electronico' => 'sofia.lopez@email.com',
                'telefono' => '+52 55 3333 6666',
                'mensaje' => 'Necesito información sobre el alojamiento recomendado cerca del evento.',
                'estado' => 'en_proceso',
                'atendido' => false,
            ],
            [
                'evento_id' => $eventos->random()->id,
                'equipo_id' => $equipos->isNotEmpty() ? $equipos->random()->id : null,
                'correo_electronico' => 'pedro.gonzalez@email.com',
                'telefono' => '+52 55 2222 1111',
                'mensaje' => '¿Puedo cambiar la información de mi equipo después de registrarme?',
                'estado' => 'resuelto',
                'atendido' => true,
            ],
            [
                'evento_id' => $eventos->random()->id,
                'equipo_id' => $equipos->isNotEmpty() ? $equipos->random()->id : null,
                'correo_electronico' => 'isabel.torres@email.com',
                'telefono' => '+52 55 8888 2222',
                'mensaje' => '¿Habrá transporte desde el aeropuerto al lugar del evento?',
                'estado' => 'pendiente',
                'atendido' => false,
            ],
            [
                'evento_id' => $eventos->random()->id,
                'equipo_id' => $equipos->isNotEmpty() ? $equipos->random()->id : null,
                'correo_electronico' => 'miguel.sanchez@email.com',
                'telefono' => '+52 55 6666 4444',
                'mensaje' => 'Mi equipo tiene una discapacidad. ¿Hay accesibilidad en el lugar del evento?',
                'estado' => 'en_proceso',
                'atendido' => false,
            ],
            [
                'evento_id' => $eventos->random()->id,
                'equipo_id' => $equipos->isNotEmpty() ? $equipos->random()->id : null,
                'correo_electronico' => 'elena.ramirez@email.com',
                'telefono' => '+52 55 1111 7777',
                'mensaje' => '¿Cuál es la política de cancelación del evento?',
                'estado' => 'resuelto',
                'atendido' => true,
            ]
        ];

        foreach ($mensajes as $mensaje) {
            BuzonAsistencia::create($mensaje);
        }

        $this->command->info('Seeder de Buzón de Asistencia ejecutado exitosamente. Se crearon ' . count($mensajes) . ' mensajes de ejemplo.');
    }
}
