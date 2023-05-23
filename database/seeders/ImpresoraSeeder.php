<?php

namespace Database\Seeders;

use App\Models\Impresora;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImpresoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $impresoras = [
            ['nombre' => 'Impresora Uno'],
            ['nombre' => 'Impresora Dos'],
        ];

        foreach ($impresoras as $impresora) {
            Impresora::create($impresora);
        }
    }
}
