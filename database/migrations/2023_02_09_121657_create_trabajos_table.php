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
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pedido', $precision = 0)->nullable();
            $table->string('numero_ot')->nullable()->unique();       // Nro. de OT
            $table->unsignedBigInteger('pedido_id')->constrained();
            $table->date('fecha_entrega', $precision = 0)->nullable();
            $table->unsignedBigInteger('cliente_id')->constrained();
            $table->string('razonsocial',100)->nullable()->unique();
            $table->unsignedBigInteger('estado_id')->default(1)->contrained();       // Estado actual
            $table->string('estado_nombre',100)->nullable();        // Nombre del estado actual de la OT
            $table->dateTime('estado_fecha', $precision = 0)->nullable();  // Muestra la fecha/hora de inicio del estado actual
            $table->string('trabajo_nombre',100)->nullable();   // Nombre del trabajo - Ver como se usa con ARTICULO_NOMBRE
            $table->double('ancho')->nullable();        
            $table->double('largo')->nullable();        
            $table->double('espesor')->nullable();      // Este espesor determina si es AD/BD ??
            $table->unsignedBigInteger('material_id')->nullable()->constrained('materiales');     // AD / BD (depende del espesor)
            $table->string('material_nombre',20)->nullable();
            $table->double('material_pesoespecifico')->nullable();
            $table->unsignedBigInteger('color_id')->nullable()->constrained('colores');        // Numero del color
            $table->string('color_nombre',80)->nullable();
            $table->unsignedInteger('bolsa_id')->nullable()->constrained('bolsas');        // Tipo de bolsa (tubo/fuelle)
            $table->string('bolsa_nombre',20)->nullable();
            $table->boolean('bolsa_fuelle')->nullable(); // True/false dependiendo si tiene o no fuelle
            $table->string('bolsa_largo_fuelle',6)->nullable()->default(0); // Cms del fuelle (depende del tip de bolsa) o la T (Tubo)
            $table->unsignedBigInteger('tratado_id')->nullable()->constrained('tratados');      // 1c / 1.2 (1cara / 2 colores)
            $table->string('tratado_nombre',40)->nullable();
            $table->unsignedBigInteger('cantidad_bolsas')->nullable(); // Cantidad de bolsas de la OT
            $table->unsignedBigInteger('cantidad_bolsas_trabajo')->nullable(); // Cantidad de bolsas de la OT o lo que ponga al modificar el TRABAJO
            $table->unsignedBigInteger('corte_id')->nullable()->constrained();        // Comun/riñon/camiseta...
            $table->string('corte_nombre',80)->nullable();
            $table->double('metros')->nullable()->default(0);       // Surge de formula
            $table->double('peso')->nullable()->default(0);         // Surge de formula
            $table->double('precio_unitario')->nullable()->default(0);         
            $table->double('iva')->nullable()->default(0);         
            $table->double('precio_iva')->nullable()->default(0);         
            $table->double('precio_total')->nullable()->default(0);         // Surge de formula
            $table->integer('bultos')->nullable()->default(0);         // Cantidad de bultos
            $table->boolean('trabajo_activo')->nullable()->default(true);
            $table->boolean('reclamo')->nullable()->default(false);
            $table->boolean('reclamo_cerrado')->nullable()->default(false);
            $table->text('reclamo_detalle')->nullable();
            $table->boolean('anulada')->nullable()->default(false);
            $table->text('observaciones')->nullable();

            // $table->string('full_mes')->virtualAs('concat(nombre, \' - A:\', orden, \' L:\', orden, \' E:\', orden)');

            $table->timestamps();
            $table->index('fecha_pedido'); //
            $table->index('fecha_entrega'); //
            $table->index('razonsocial'); //
            $table->index('estado_nombre'); //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajos');
    }
};
