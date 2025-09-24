<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Evento;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $evento = Evento::first();

        // Crear usuario administrador
        User::create([
            'name' => 'Administrador CECYTE',
            'email' => 'admin@cecyte.com',
            'password' => Hash::make('CECYTE2025Admin!'),
            'role' => 'admin',
            'evento_id' => $evento?->id,
        ]);

        // Crear dos usuarios de prueba
        User::create([
            'name' => 'Usuario Prueba 1',
            'email' => 'prueba1@cecyte.com',
            'password' => Hash::make('prueba123'),
            'role' => 'usuario',
            'evento_id' => $evento?->id,
        ]);

        User::create([
            'name' => 'Usuario Prueba 2',
            'email' => 'prueba2@cecyte.com',
            'password' => Hash::make('prueba123'),
            'role' => 'usuario',
            'evento_id' => $evento?->id,
        ]);

        // Estados de México con sus contraseñas específicas
        $estados = [
            'Aguascalientes' => 'Aguascalientes2025',
            'Baja California' => 'BajaCalifornia2025',
            'Baja California Sur' => 'BajaCaliforniaSur2025',
            'Campeche' => 'Campeche2025',
            'Chiapas' => 'Chiapas2025',
            'Chihuahua' => 'Chihuahua2025',
            'Ciudad de México' => 'CDMX2025',
            'Coahuila' => 'Coahuila2025',
            'Colima' => 'Colima2025',
            'Durango' => 'Durango2025',
            'Guanajuato' => 'Guanajuato2025',
            'Guerrero' => 'Guerrero2025',
            'Hidalgo' => 'Hidalgo2025',
            'Jalisco' => 'Jalisco2025',
            'México' => 'EstadoMexico2025',
            'Michoacán' => 'Michoacan2025',
            'Morelos' => 'Morelos2025',
            'Nayarit' => 'Nayarit2025',
            'Nuevo León' => 'NuevoLeon2025',
            'Oaxaca' => 'Oaxaca2025',
            'Puebla' => 'Puebla2025',
            'Querétaro' => 'Queretaro2025',
            'Quintana Roo' => 'QuintanaRoo2025',
            'San Luis Potosí' => 'SanLuisPotosi2025',
            'Sinaloa' => 'Sinaloa2025',
            'Sonora' => 'Sonora2025',
            'Tabasco' => 'Tabasco2025',
            'Tamaulipas' => 'Tamaulipas2025',
            'Tlaxcala' => 'Tlaxcala2025',
            'Veracruz' => 'Veracruz2025',
            'Yucatán' => 'Yucatan2025',
            'Zacatecas' => 'Zacatecas2025'
        ];

        // Crear usuarios para cada estado con su contraseña específica
        foreach ($estados as $estado => $password) {
            $email = strtolower(str_replace(' ', '', $estado)) . '@cecyte.com';
            User::create([
                'name' => 'Representante ' . $estado,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'usuario',
                'evento_id' => $evento?->id,
            ]);
        }
    }
} 