<?php

namespace Database\Seeders;

use App\Models\Cortadora;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CortadoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cortadoras = [
            ['nombre' => 'Cortadora Uno'],
            ['nombre' => 'Cortadora Dos'],
            ['nombre' => 'Cortadora Tres'],
        ];

        foreach ($cortadoras as $cortadora) {
            Cortadora::create($cortadora);
        }
    }
}
