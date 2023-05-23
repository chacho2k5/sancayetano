<?php

namespace Database\Seeders;

use App\Models\Iva;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ivas = [
            ['nombre' => 'IVA Responsable Inscripto', 'siglas' => ''],
            ['nombre' => 'Responsable Monotributo', 'siglas' => ''],
            ['nombre' => 'IVA Sujeto Exento', 'siglas' => ''],
            ['nombre' => 'Consumidor Final', 'siglas' => ''],
            // ['nombre' => 'Sin definir', 'siglas' => ''],
            // ['nombre' => 'IVA Responsable No Inscripto', 'siglas' => ''],
            // ['nombre' => 'IVA No Responsable', 'siglas' => ''],
            // ['nombre' => 'IVA Liberado - Ley Nº 19.640', 'siglas' => ''],
            // ['nombre' => 'IVA Responsable Inscripto – Agente de Percepción', 'siglas' => ''],
            // ['nombre' => 'Pequeño Contribuyente Eventual', 'siglas' => ''],
            // ['nombre' => 'Monotributista Social', 'siglas' => ''],
            // ['nombre' => 'Pequeño Contribuyente Eventual Social', 'siglas' => ''],
        ];

        foreach ($ivas as $iva) {
            Iva::create($iva);
        }
    }
}
