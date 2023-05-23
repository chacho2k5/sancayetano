<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            ['orden' => '1', 'nombre' => 'CARGADO'],
            ['orden' => '2', 'nombre' => 'GENERADO'],
            ['orden' => '3', 'nombre' => 'PRODUCCION'],
            ['orden' => '4', 'nombre' => 'TERMINADO'],
            ['orden' => '5', 'nombre' => 'FACTURADO'],
            ['orden' => '6', 'nombre' => 'DESPACHADO'],
            ['orden' => '7', 'nombre' => 'ENTREGADO'],
            ['orden' => '8', 'nombre' => 'ANULADO'],
        ];

        foreach ($estados as $estado) {
            Estado::create($estado);
        }
    }
}
