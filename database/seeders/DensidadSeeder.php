<?php

namespace Database\Seeders;

use App\Models\Densidad;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DensidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $densidades = [
            ['nombre' => 'AD', 'detalle' => 'Alta Densidad', 'pesoespecifico' => '1.92'],
            ['nombre' => 'BD', 'detalle' => 'Baja Densidad', 'pesoespecifico' => '1.84'],
        ];

        foreach ($densidades as $densidad) {
            Densidad::create($densidad);
        }
    }
}
