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
        Schema::create('materiales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',20)->unique();
            $table->string('detalle',80)->nullable();
            $table->double('pesoespecifico');
            $table->double('min')->nullable()->default(0);      // Indicaria el espesor min para determinar si es de AD o BD?
            $table->double('max')->nullable()->default(0);
            $table->string('material')->virtualAs('concat(nombre, \' - \', detalle)');
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
        Schema::dropIfExists('materiales');
    }
};
