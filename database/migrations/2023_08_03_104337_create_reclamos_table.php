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
        Schema::create('reclamos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio', $precision = 0)->require();
            $table->date('fecha_fin', $precision = 0)->nullable();
            $table->unsignedBigInteger('cliente_id')->constrained();
            $table->unsignedBigInteger('pedido_id')->constrained();
            $table->string('observaciones',3000)->require();
            $table->boolean('cerrado')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reclamos');
    }
};
