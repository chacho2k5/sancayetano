<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'razonsocial' => $this->faker->unique()->company(),
            'contacto' => $this->faker->lastName(),
            'cuit' => $this->faker->unique()->numerify('###########'),
            'iva_id' => $this->faker->numberBetween(2,6),
            'telefono1' => $this->faker->phoneNumber(),
            'telefono2' => $this->faker->phoneNumber(),
            'correo' => $this->faker->unique()->email(),
            'calle_nombre' => $this->faker->streetName(),
            'calle_numero' => $this->faker->buildingNumber(),
            'codigo_postal' => $this->faker->postcode(),
            // 'barrio_id' => $this->faker->numberBetween(1,200),
            // 'localidad_id' => $this->faker->numberBetween(1,200),
            'barrio_nombre' => $this->faker->city(),
            'localidad_nombre' => $this->faker->city(),
            'provincia_id' => $this->faker->numberBetween(1,25),
            'fecha_alta' => $this->faker->date(),
            'observaciones' => $this->faker->sentence(6,false)
        ];
    }
}
