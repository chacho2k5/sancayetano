<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materiales = [
            // ['nombre' => 'AD', 'detalle' => 'Alta Densidad', 'pesoespecifico' => '1.92', 'min' => '', 'max' => ''],
            // ['nombre' => 'BD', 'detalle' => 'Baja Densidad', 'pesoespecifico' => '1.84', 'min' => '', 'max' => ''],
            ['nombre' => 'AD', 'detalle' => 'Alta Densidad', 'pesoespecifico' => '1.92'],
            ['nombre' => 'BD', 'detalle' => 'Baja Densidad', 'pesoespecifico' => '1.84'],
        ];

        foreach ($materiales as $material) {
            Material::create($material);
        }
    }
}
