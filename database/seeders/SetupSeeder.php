<?php

namespace Database\Seeders;

use App\Models\Setup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setups = [
            ['iva1' => '21', 'iva2' => '10.5'],
        ];

        foreach ($setups as $setup) {
            Setup::create($setup);
        }
    }
}
