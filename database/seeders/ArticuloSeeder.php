<?php

namespace Database\Seeders;

use App\Models\Articulo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Articulo::factory(300)->create();
        Articulo::factory(30)->create();
        
    }
}
