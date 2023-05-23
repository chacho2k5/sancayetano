<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ArticuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cliente_id' => $this->faker->numberBetween(1,100),
            'nombre' => $this->faker->unique()->company(),
            'ancho' => $this->faker->numberBetween(10,100),
            'largo' => $this->faker->numberBetween(35,150),
            'espesor' => $this->faker->numberBetween(20,120),
            'material_id' => $this->faker->numberBetween(1,2),
            'color_id' => $this->faker->numberBetween(1,25),
            'bolsa_id' => $this->faker->numberBetween(1,2),
            'fuelle' => $this->faker->numberBetween(10,20),
            'tratado_id' => $this->faker->numberBetween(1,11),
            'corte_id' => $this->faker->numberBetween(1,5),
            'observaciones' => $this->faker->sentence(6,false),
            'activo' => $this->faker->boolean(true),
            // $table->string('trabajo')->virtualAs('concat(nombre, \' - A:\', ancho, \' L:\', largo, \' E:\', espesor)');
        ];
    }
}
