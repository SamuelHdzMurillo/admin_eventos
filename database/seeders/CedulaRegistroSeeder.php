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
        $equipo = Equipo::first();

        // Solo una cédula de registro de ejemplo
        CedulaRegistro::create([
            'equipo_id' => $equipo->id,
            'participantes' => [
                'Juan Pérez - Chef Principal'
            ],
            'asesores' => [
                'Dr. Roberto Silva - Asesor Académico'
            ],
            'estado' => 'aprobada'
        ]);
    }
} 