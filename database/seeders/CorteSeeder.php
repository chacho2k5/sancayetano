<?php

namespace Database\Seeders;

use App\Models\Corte;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CorteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cortes = [
            ['nombre' => 'Comun'],
            ['nombre' => 'Riñon'],
            ['nombre' => 'Camiseta'],
            ['nombre' => 'Bobina'],
            ['nombre' => 'Lamina'],
        ];

        foreach ($cortes as $corte) {
            Corte::create($corte);
        }
    }
}
