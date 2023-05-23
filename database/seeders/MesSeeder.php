<?php

namespace Database\Seeders;

use App\Models\Mes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meses = [
            ['orden' => '1', 'nombre' => 'Enero'],
            ['orden' => '2', 'nombre' => 'Febrero'],
            ['orden' => '3', 'nombre' => 'Marzo'],
            ['orden' => '4', 'nombre' => 'Abril'],
            ['orden' => '5', 'nombre' => 'Mayo'],
            ['orden' => '6', 'nombre' => 'Junio'],
            ['orden' => '7', 'nombre' => 'Julio'],
            ['orden' => '8', 'nombre' => 'Agosto'],
            ['orden' => '9', 'nombre' => 'Septiembre'],
            ['orden' => '10', 'nombre' => 'Octubre'],
            ['orden' => '11', 'nombre' => 'Noviembre'],
            ['orden' => '12', 'nombre' => 'Diciembre'],
        ];

        foreach ($meses as $mes) {
            Mes::create($mes);
        }
    }
}
