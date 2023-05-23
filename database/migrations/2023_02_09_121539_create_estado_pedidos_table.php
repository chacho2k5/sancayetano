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
        Schema::create('estado_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pedido_id');
            $table->unsignedInteger('estado_id');
            // De acuerdo al valor de accion, se decide si es el ultimo evento y se cierra
            // o si tiene un valor indica que hay q planchar etc etc
            // $table->unsignedTinyInteger('accion')->nullable()->default(0);
            $table->dateTime('fecha_inicio', $precision = 0);  // Muestra la fecha/hora de inicio del estado actual
            $table->dateTime('fecha_final', $precision = 0);  // Muestra la fecha/hora de inicio del estado actual
            // $table->string('observaciones')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->index(['pedido_id', 'estado_id'],);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_pedidos');
    }
};
