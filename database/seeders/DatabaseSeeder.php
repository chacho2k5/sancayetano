<?php

namespace Database\Seeders;

use App\Models\Articulo;
use App\Models\Densidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // ArticuloSeeder::class,
            BarrioSeeder::class,
            BolsaSeeder::class,
            CalleSeeder::class,
            // ClienteSeeder::class,
            ColorSeeder::class,
            CortadoraSeeder::class,
            CorteSeeder::class,
            DensidadSeeder::class,
            // EmpleadoSeeder::class,
            EstadoSeeder::class,
            ExtrusoraSeeder::class,
            ImpresoraSeeder::class,
            IvaSeeder::class,
            LocalidadSeeder::class,
            MaterialSeeder::class,
            MesSeeder::class,
            // OrdenTrabajoSeeder::class,
            // PedidoSeeder::class,
            ProvinciaSeeder::class,
            SetupSeeder::class,
            TratadoSeeder::class,
            UserSeeder::class,
        ]);
    }
}