<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participante;
use App\Models\Equipo;

class ParticipanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipo = Equipo::first();

        // Solo un participante de ejemplo
        Participante::create([
            'equipo_id' => $equipo->id,
            'nombre_participante' => 'Juan Pérez',
            'rol_participante' => 'Chef Principal',
            'talla_participante' => 'M',
            'telefono_participante' => '8181111111',
            'matricula_participante' => '2024001',
            'correo_participante' => 'juan.perez@cecyte.com',
            'plantel_participante' => 'CECYTE Plantel Central',
            'plantelcct' => '19DCT0001A',
            'medicamentos' => 'Ninguno',
            'foto_credencial' => 'juan_perez.jpg',
            'semestre_participante' => '6to',
            'especialidad_participante' => 'Cocina Internacional',
            'seguro_facultativo' => true,
            'tipo_sangre_participante' => 'O+',
            'alergico' => false,
            'alergias' => null
        ]);
    }
} 