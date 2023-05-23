<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'apellido' => $this->faker->lastName(),
            'nombres' => $this->faker->firstName(),
            'documento_numero' => $this->faker->unique()->numerify('########'),
            'telefono' => $this->faker->phoneNumber(),
            'correo' => $this->faker->unique()->email(),
            'calle_nombre' => $this->faker->streetName(),
            'calle_numero' => $this->faker->buildingNumber(),
            'codigo_postal' => $this->faker->postcode(),
            'barrio_nombre' => $this->faker->city(),
            'localidad_nombre' => $this->faker->city(),
            'provincia_id' => $this->faker->numberBetween(1,25),
            'fecha_alta' => $this->faker->date(),
            'observaciones' => $this->faker->sentence(6,false)
        ];
    }
}
