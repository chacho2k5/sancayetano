<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bolsas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',80)->unique();    // Tubo/Fuelle
            $table->boolean('fuelle');       // Si es False se muestra la T, sino el largo del Fuelle
            $table->smallInteger('orden')->nullable()->default('1');       // Orden para mostrar los datos
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bolsas');
    }
};
