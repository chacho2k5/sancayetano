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
            ['nombre' => 'FABRICA', 'orden' => '1'],
            ['nombre' => 'LAVADO', 'orden' => '2'],
            ['nombre' => 'MEZCLA C/LINEAL', 'orden' => '3'],
            ['nombre' => 'VIRGEN', 'orden' => '4'],
        ];

        foreach ($materiales as $material) {
            Material::create($material);
        }
    }
}
