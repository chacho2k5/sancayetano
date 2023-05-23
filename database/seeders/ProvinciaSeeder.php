<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provincias = [
            ['nombre' => 'Buenos Aires'],
            ['nombre' => 'Catamarca'],
            ['nombre' => 'Chaco'],
            ['nombre' => 'Chubut'],
            ['nombre' => 'Ciudad Autónoma de Buenos Aires'],
            ['nombre' => 'Córdoba'],
            ['nombre' => 'Corrientes'],
            ['nombre' => 'Entre Ríos'],
            ['nombre' => 'Formosa'],
            ['nombre' => 'Jujuy'],
            ['nombre' => 'La Pampa'],
            ['nombre' => 'La Rioja'],
            ['nombre' => 'Mendoza'],
            ['nombre' => 'Misiones'],
            ['nombre' => 'Neuquén'],
            ['nombre' => 'Río Negro'],
            ['nombre' => 'Salta'],
            ['nombre' => 'San Juan'],
            ['nombre' => 'San Luis'],
            ['nombre' => 'Santa Cruz'],
            ['nombre' => 'Santa Fe'],
            ['nombre' => 'Santiago del Estero'],
            ['nombre' => 'Tierra del Fuego, Antártida e Islas del Atlántico Sur'],
            ['nombre' => 'Tucumán'],
        ];

        foreach ($provincias as $provincia) {
            Provincia::create($provincia);
        }
    }
}
