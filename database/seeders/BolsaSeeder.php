<?php

namespace Database\Seeders;

use App\Models\Bolsa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BolsaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bolsas = [
            ['nombre' => 'Tubo', 'fuelle' => false, 'orden' => '1'],
            ['nombre' => 'Tubo abierto 1 lado', 'fuelle' => false, 'orden' => '2'],
            ['nombre' => 'Fuelle', 'fuelle' => true, 'orden' => '3'],
            ['nombre' => 'Fuelle abierto 1 lado', 'fuelle' => true, 'orden' => '4'],
            ['nombre' => 'Lamina', 'fuelle' => false, 'orden' => '5'],
        ];

        foreach ($bolsas as $bolsa) {
            Bolsa::create($bolsa);
        }
    }
}
