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
        $hospedajes = [
            [
                'nombre' => 'Hotel Plaza Central',
                'direccion' => 'Av. Principal 123, Centro Histórico',
                'numero_telefonico' => '+52 555-123-4567',
                'correo' => 'reservas@plazacentral.com',
                'img' => 'hotel-plaza-central.jpg'
            ],
            [
                'nombre' => 'Resort Costa Azul',
                'direccion' => 'Carretera Costera Km 45, Playa Dorada',
                'numero_telefonico' => '+52 555-987-6543',
                'correo' => 'info@costazul.com',
                'img' => 'resort-costa-azul.jpg'
            ],
            [
                'nombre' => 'Hostal El Viajero',
                'direccion' => 'Calle Juárez 78, Zona Universitaria',
                'numero_telefonico' => '+52 555-456-7890',
                'correo' => 'contacto@elviajero.com',
                'img' => 'hostal-el-viajero.jpg'
            ],
            [
                'nombre' => 'Hotel Business Center',
                'direccion' => 'Blvd. Corporativo 200, Zona Financiera',
                'numero_telefonico' => '+52 555-321-0987',
                'correo' => 'reservaciones@businesscenter.com',
                'img' => 'hotel-business-center.jpg'
            ],
            [
                'nombre' => 'Cabañas La Montaña',
                'direccion' => 'Camino Forestal 15, Sierra Nevada',
                'numero_telefonico' => '+52 555-654-3210',
                'correo' => 'info@lamontana.com',
                'img' => 'cabanas-la-montana.jpg'
            ]
        ];

        foreach ($hospedajes as $hospedaje) {
            Hospedaje::create($hospedaje);
        }
    }
}
