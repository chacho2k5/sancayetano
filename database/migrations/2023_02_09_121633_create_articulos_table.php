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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cliente_id')->nullable()->constrained();
            $table->string('nombre',100);
            $table->double('ancho')->nullable();        //
            $table->double('largo')->nullable();        //
            $table->double('espesor')->nullable();      // Este espesor determina si es AD/BD
            $table->unsignedInteger('material_id')->nullable()->constrained('materiales');     // AD / BD (depende del espesor)
            $table->unsignedInteger('color_id')->nullable()->constrained('colores');        // Numero del color
            $table->unsignedInteger('bolsa_id')->nullable()->constrained();        // Tipo de bolsa (tubo/fuelle)
            $table->double('fuelle')->nullable();       // Cms del fuelle (depende del tip de bolsa)
            $table->unsignedInteger('tratado_id')->nullable()->constrained();      // 1c / 1.2 (1cara / 2 colores)
            $table->unsignedInteger('corte_id')->nullable()->constrained();        // 1c / 1.2 (1cara / 2 colores)
            $table->string('observaciones',2000)->nullable();
            $table->boolean('activo')->default(true);
            // Columna virtual
            // $table->string('trabajo')->virtualAs('concat(nombre, \' A: \', ancho)');
            $table->string('trabajo')->virtualAs('concat(nombre, \' - A:\', ancho, \' L:\', largo, \' E:\', espesor)');
            $table->timestamps();

            $table->index('nombre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
};
