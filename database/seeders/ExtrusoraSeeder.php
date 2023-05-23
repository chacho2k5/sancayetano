<?php

namespace Database\Seeders;

use App\Models\Extrusora;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExtrusoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $extrusoras = [
            ['nombre' => 'Extrusora Uno'],
            ['nombre' => 'Extrusora Tres'],
            ['nombre' => 'Extrusora Cuatro'],
            ['nombre' => 'Extrusora Cinco'],
        ];

        foreach ($extrusoras as $extrusora) {
            Extrusora::create($extrusora);
        }
    }
}
