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
            ['nombre' => 'Tubo', 'fuelle' => false],
            ['nombre' => 'Fuelle', 'fuelle' => true],
        ];

        foreach ($bolsas as $bolsa) {
            Bolsa::create($bolsa);
        }
    }
}
