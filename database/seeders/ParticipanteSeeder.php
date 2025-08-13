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
        $equipos = Equipo::all();

        $participantes = [
            [
                'equipo_id' => $equipos->first()->id,
                'nombre_participante' => 'Juan Pérez',
                'rol_participante' => 'Chef Principal',
                'talla_participante' => 'M',
                'telefono_participante' => '8181111111',
                'matricula_participante' => '2024001',
                'correo_participante' => 'juan.perez@email.com',
                'plantel_participante' => 'Instituto Culinario del Norte',
                'plantelcct' => '19DCT0001A',
                'medicamentos' => 'Ninguno',
                'foto_credencial' => 'juan_perez.jpg',
                'semestre_participante' => '6to',
                'especialidad_participante' => 'Cocina Internacional',
                'seguro_facultativo' => true,
                'tipo_sangre_participante' => 'O+',
                'alergico' => false,
                'alergias' => null
            ],
            [
                'equipo_id' => $equipos->first()->id,
                'nombre_participante' => 'Sofía López',
                'rol_participante' => 'Sous Chef',
                'talla_participante' => 'S',
                'telefono_participante' => '8182222222',
                'matricula_participante' => '2024002',
                'correo_participante' => 'sofia.lopez@email.com',
                'plantel_participante' => 'Instituto Culinario del Norte',
                'plantelcct' => '19DCT0001A',
                'medicamentos' => 'Ninguno',
                'foto_credencial' => 'sofia_lopez.jpg',
                'semestre_participante' => '5to',
                'especialidad_participante' => 'Repostería',
                'seguro_facultativo' => true,
                'tipo_sangre_participante' => 'A+',
                'alergico' => true,
                'alergias' => 'Mariscos, nueces'
            ]
        ];

        foreach ($participantes as $participante) {
            Participante::create($participante);
        }
    }
} 