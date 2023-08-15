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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            // $table->string('razonsocial',100)->nullable()->unique();
            $table->string('razonsocial',100)->nullable();
            $table->string('contacto',100)->nullable();
            // $table->string('cuit',13)->nullable()->unique();
            $table->string('cuit',13)->nullable();
            $table->unsignedSmallInteger('iva_id')->nullable()->default(1);
            $table->string('telefono1',20)->nullable();
            $table->string('telefono2',20)->nullable();
            // $table->string('correo',100)->nullable()->unique();
            $table->string('correo',100)->nullable();
            $table->string('calle_nombre',100)->nullable();
            $table->string('calle_numero',5)->nullable();
            $table->string('codigo_postal',20)->nullable();
            $table->unsignedSmallInteger('barrio_id')->nullable();
            $table->string('barrio_nombre',100)->nullable();
            $table->unsignedSmallInteger('localidad_id')->nullable();
            $table->string('localidad_nombre',100)->nullable();
            // $table->foreignId('provincia_id')->nullable()->constrained();
            $table->unsignedSmallInteger('provincia_id')->nullable();
            $table->string('provincia_nombre',100)->nullable();
            $table->date('fecha_alta')->nullable();
            $table->string('base_tango',20)->nullable();
            $table->string('cliente_tango',20)->nullable();
            $table->string('observaciones',1000)->nullable();
            $table->timestamps();
            // $table->index('contacto');
            // $table->index('localidad_nombre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
