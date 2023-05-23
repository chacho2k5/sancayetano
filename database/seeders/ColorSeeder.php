<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colores = [
            ['nombre' => 'Amar Huevo Ad'],
            ['nombre' => 'Amarillo'],
            ['nombre' => 'Amarillo c/ Cristal'],
            ['nombre' => 'Amarillo Huevo'],
            ['nombre' => 'Azul'],
            ['nombre' => 'Bl Mezcla Lav'],
            ['nombre' => 'Blanco'],
            ['nombre' => 'Blanco AD'],
            ['nombre' => 'Blanco Lavado'],
            ['nombre' => 'Celeste Lav'],
            ['nombre' => 'Celeste Tonaliz'],
            ['nombre' => 'Color'],
            ['nombre' => 'Color Claro'],
            ['nombre' => 'Cristal'],
            ['nombre' => 'Cristal AD'],
            ['nombre' => 'Cristal Virgen'],
            ['nombre' => 'Gris'],
            ['nombre' => 'Lavado'],
            ['nombre' => 'Lavado Claro'],
            ['nombre' => 'Marrón Lav'],
            ['nombre' => 'Naranaja c/ Cristal'],
            ['nombre' => 'Naranja Lav'],
            ['nombre' => 'Negro '],
            ['nombre' => 'Negro AD'],
            ['nombre' => 'Negro c/ Cristal'],
            ['nombre' => 'Rojo'],
            ['nombre' => 'Rojo c/ Cristal'],
            ['nombre' => 'Verde'],
            ['nombre' => 'Yute c/ Lavado'],

        ];

        foreach ($colores as $color) {
            Color::create($color);
        }
    }
}
