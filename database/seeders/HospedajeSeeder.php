<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hospedaje;

class HospedajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Solo un hospedaje de ejemplo
        Hospedaje::create([
            'nombre' => 'Hotel Plaza Central',
            'direccion' => 'Av. Principal 123, Centro Histórico',
            'numero_telefonico' => '+52 555-123-4567',
            'correo' => 'reservas@plazacentral.com',
            'img' => 'hotel-plaza-central.jpg'
        ]);
    }
}
