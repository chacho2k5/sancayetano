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
        $tratados = [
            ['nombre' => '1', 'detalle' => '', 'formula' => '1'],
            ['nombre' => '1.1', 'detalle' => '', 'formula' => '1'],
            ['nombre' => '1.2', 'detalle' => '', 'formula' => '1'],
            ['nombre' => '1.3', 'detalle' => '', 'formula' => '1'],
            ['nombre' => '1.4', 'detalle' => '', 'formula' => '1'],
            ['nombre' => '2', 'detalle' => '', 'formula' => '2'],
            ['nombre' => '2.1', 'detalle' => '', 'formula' => '2'],
            ['nombre' => '2.2', 'detalle' => '', 'formula' => '2'],
            ['nombre' => '2.3', 'detalle' => '', 'formula' => '2'],
            ['nombre' => '2.4', 'detalle' => '', 'formula' => '2'],
            ['nombre' => 'Liso', 'detalle' => '', 'formula' => '1'],
        ];

        foreach ($tratados as $tratado) {
            Tratado::create($tratado);
        }
    }
}
