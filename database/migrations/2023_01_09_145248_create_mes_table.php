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
        Schema::create('meses', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('orden');
            $table->string('nombre',80)->unique();
            // $table->string('full_mes')->virtualAs('concat(nombre, \' - A:\', orden, \' L:\', orden, \' E:\', orden)');
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
        Schema::dropIfExists('meses');
    }
};
