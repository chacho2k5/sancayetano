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
            ['nombre' => 'Bobina', 'orden' => '1'],
            ['nombre' => 'Comun', 'orden' => '2'],
            ['nombre' => 'Riñon', 'orden' => '3'],
            ['nombre' => 'Camiseta', 'orden' => '4'],
            ['nombre' => 'Lateral Riñon', 'orden' => '5'],
            ['nombre' => 'Sin Soldar', 'orden' => '6'],
        ];

        foreach ($cortes as $corte) {
            Corte::create($corte);
        }
    }
}
