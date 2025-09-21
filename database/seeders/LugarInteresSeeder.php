<?php

namespace Database\Seeders;

use App\Models\LugarInteres;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LugarInteresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Solo un lugar de interés de ejemplo
        LugarInteres::create([
            'nombre' => 'Centro Histórico',
            'direccion' => 'Plaza Principal, Centro de la Ciudad',
            'web' => 'https://centrohistorico.com',
            'estatus' => 'activo',
            'descripcion' => 'Zona histórica con arquitectura colonial y museos importantes.'
        ]);
    }
}
