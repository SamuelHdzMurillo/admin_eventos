<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hospedaje>
 */
class HospedajeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipos = ['Hotel', 'Resort', 'Hostal', 'Cabaña', 'Apartamento', 'Villa'];
        $tipo = $this->faker->randomElement($tipos);
        
        return [
            'nombre' => $tipo . ' ' . $this->faker->company(),
            'direccion' => $this->faker->address(),
            'numero_telefonico' => '+52 555-' . $this->faker->numberBetween(100, 999) . '-' . $this->faker->numberBetween(1000, 9999),
            'correo' => $this->faker->companyEmail(),
            'img' => $this->faker->imageUrl(640, 480, 'hotel', true) . '.jpg',
        ];
    }
}
