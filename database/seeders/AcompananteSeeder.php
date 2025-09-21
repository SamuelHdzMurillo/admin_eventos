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
        $equipo = Equipo::first();

        // Solo un acompañante de ejemplo
        Acompanante::create([
            'equipo_id' => $equipo->id,
            'nombre_acompanante' => 'Dr. Roberto Silva',
            'rol' => 'Asesor Académico',
            'puesto' => 'Profesor Titular',
            'talla' => 'L',
            'telefono' => '8183333333',
            'email' => 'roberto.silva@cecyte.com'
        ]);
    }
} 