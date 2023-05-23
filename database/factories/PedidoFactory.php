<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fecha_pedido' => $this->faker->dateTimeBetween('-12 weeks','+1 weeks'),
            'numero_ot_mensual' => $this->faker->unique()->numberBetween(1,2000),
            'numero_ot' => $this->faker->dayOfMonth('-12 weeks') . $this->faker->month('-12 weeks').$this->faker->year() . '-' . $this->faker->numberBetween(1,2000),
            // 'numero_ot' => $this->faker->numerify('######-####'),
            'fecha_entrega' => $this->faker->dateTimeBetween('-6 weeks','+6 weeks'),
            'cliente_id' => $this->faker->numberBetween(1,20),
            'razonsocial' => $this->faker->unique()->company(),
            'estado_id' => $this->faker->numberBetween(1,3),
            // 'estado_nombre',
            // 'estado_fecha',
            // 'mes_id',
            // 'mes',
            'trabajo_nombre' => $this->faker->words(3,true),
            'ancho' => $this->faker->numberBetween(10,150),
            'largo' => $this->faker->numberBetween(30,220),
            'espesor' => $this->faker->numberBetween(10,80),
            'material_id' => $this->faker->numberBetween(1,2),
            // 'material_nombre',
            'material_pesoespecifico' => $this->faker->randomElement(['1.84','1.92']),
            'color_id' => $this->faker->numberBetween(1,25),
            // 'color_nombre',
            'bolsa_id' => $this->faker->numberBetween(1,2),
            // 'bolsa_nombre',
            // 'bolsa_fuelle',
            'bolsa_largo_fuelle' => $this->faker->randomElement(['T','7','5','4','9','T','8','14','T','6','10','T','T']),
            'tratado_id' => $this->faker->numberBetween(1,11),
            // 'tratado_nombre',
            'cantidad_bolsas' => $this->faker->numberBetween(100,9000),
            'corte_id' => $this->faker->numberBetween(1,5),
            // 'corte_nombre',
            'metros' => $this->faker->numberBetween(1000,25000),
            'peso' => $this->faker->numberBetween(100,8500),
            // 'metros',
            // 'peso',
            // 'precio_unitario',
            // 'precio_total',
            'observaciones' => $this->faker->sentence(6,false),
            'trabajo_activo' => $this->faker->randomElement(['1','0']),
        ];
    }
}
