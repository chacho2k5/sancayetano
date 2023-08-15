<?php

namespace Database\Seeders;

use App\Models\Tratado;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TratadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $tratados = [
        //     ['nombre' => '1', 'detalle' => '', 'formula' => '1'],
        //     ['nombre' => '1.1', 'detalle' => '', 'formula' => '1'],
        //     ['nombre' => '1.2', 'detalle' => '', 'formula' => '1'],
        //     ['nombre' => '1.3', 'detalle' => '', 'formula' => '1'],
        //     ['nombre' => '1.4', 'detalle' => '', 'formula' => '1'],
        //     ['nombre' => '2', 'detalle' => '', 'formula' => '2'],
        //     ['nombre' => '2.1', 'detalle' => '', 'formula' => '2'],
        //     ['nombre' => '2.2', 'detalle' => '', 'formula' => '2'],
        //     ['nombre' => '2.3', 'detalle' => '', 'formula' => '2'],
        //     ['nombre' => '2.4', 'detalle' => '', 'formula' => '2'],
        //     ['nombre' => 'Liso', 'detalle' => '', 'formula' => '1'],
        // ];

        $tratados = [
            ['nombre' => 'Liso', 'detalle' => '0', 'formula' => '0', 'orden' => '1'],
            ['nombre' => 'Tratar 1 cara 1 color', 'detalle' => '1.1', 'formula' => '1', 'orden' => '2'],
            ['nombre' => 'Tratar 1 cara 2 colores', 'detalle' => '1.2', 'formula' => '1', 'orden' => '3'],
            ['nombre' => 'Tratar 1 cara 3 colores', 'detalle' => '1.3', 'formula' => '1', 'orden' => '4'],
            ['nombre' => 'Tratar 1 cara 4 colores', 'detalle' => '1.4', 'formula' => '1', 'orden' => '5'],
            ['nombre' => 'Tratar 2 caras 1 color', 'detalle' => '2.1', 'formula' => '2', 'orden' => '6'],
            ['nombre' => 'Tratar 2 caras 2 colores', 'detalle' => '2.2', 'formula' => '2', 'orden' => '7'],
            ['nombre' => 'Tratar 2 caras 3 colores', 'detalle' => '2.3', 'formula' => '2', 'orden' => '8'],
            ['nombre' => 'Tratar 2 caras 4 colores', 'detalle' => '2.4', 'formula' => '2', 'orden' => '9'],
        ];

        foreach ($tratados as $tratado) {
            Tratado::create($tratado);
        }
    }
}
