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
        $evento = Evento::first();
        
        if ($evento) {
            // Solo un miembro del comité de ejemplo
            Comite::create([
                'evento_id' => $evento->id,
                'nombre' => 'Dr. Juan Pérez',
                'rol' => 'Presidente',
                'puesto' => 'Director General',
                'telefono' => '555-1234',
                'extension' => '101'
            ]);
        }
    }
}
