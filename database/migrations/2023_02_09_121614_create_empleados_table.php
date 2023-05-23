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
        Schema::disableForeignKeyConstraints();

        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('apellido',100);
            $table->string('nombres',100);
            $table->string('documento_numero',8)->nullable()->unique();  //poner CUIL ???
            $table->string('telefono',20)->nullable();
            $table->string('correo',80)->nullable()->unique();
            $table->string('calle_nombre',80)->nullable();
            $table->string('calle_numero',5)->nullable();
            $table->string('codigo_postal',20)->nullable();
            $table->string('barrio_nombre',100)->nullable();
            $table->string('localidad_nombre',100)->nullable();
            // $table->unsignedSmallInteger('provincia_id')->nullable();
            $table->foreignId('provincia_id')->nullable()->constrained('provincias');
            $table->date('fecha_alta')->nullable();
            $table->string('observaciones',1000)->nullable();
            $table->timestamps();

            $table->index(['apellido', 'nombres']);
            $table->index('localidad_nombre');
            $table->index('fecha_alta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
