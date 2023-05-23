<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Throwable;

class OrdenTrabajo extends Model
{
    use HasFactory;

    protected $table = 'orden_trabajos';
    // public $timestamps = false;

    protected $fillable = [
        'fecha_pedido',
        'numero_ot_mensual',
        'numero_ot',
        'fecha_entrega',
        'cliente_id',
        'razonsocial',
        'estado_id',
        'estado_nombre',
        'estado_fecha',
        'mes_id',
        'mes',
        'trabajo_nombre',
        'ancho',
        'largo',
        'espesor',
        'material_id',
        'material_nombre',
        'material_pesoespecifico',
        'color_id',
        'color_nombre',
        'bolsa_id',
        'bolsa_nombre',
        'bolsa_fuelle',
        'bolsa_largo_fuelle',
        'tratado_id',
        'tratado_nombre',
        'cantidad_bolsas',
        'corte_id',
        'corte_nombre',
        'metros',
        'peso',
        'precio_unitario',
        'precio_total',
        'observaciones',
        'trabajo_activo',
        'reclamo',
        'reclamo_detalle'
    ];

    // protected $appends = ['mi_estado', 'mi_asterisco'];

    protected $casts = [
        // 'lavado_formula' => 'decimal:2',
        // // chacho - Esto lo anule el 28/09
        // // 'fecha_alta' => 'datetime:d-m-Y h:i:s',
        // 'tiempo_planchado' => 'decimal:2',
        // 'tiempo_planchado_real' => 'decimal:2',
    ];

    public function fechaPedido(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('d-m-Y', strtotime($value)),
            // set: fn ($value) => 'datetime:d-m-Y h:i:s'
        );
    }

    public function fechaEntrega(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('d-m-Y', strtotime($value)),
            // set: fn ($value) => 'datetime:d-m-Y h:i:s'
        );
    }

    public function scopeUltimaOt($query, $mes)
    {
        $aux = OrdenTrabajo::whereMonth('fecha_pedido',$mes)->count();
        if ($aux == 0) {
            return $aux;
        } else {
            return $query->whereMonth('fecha_pedido',$mes)
                            ->max('numero_ot_mensual');
        }
    }

    // {
    //     return $query->where('created_at', '>', now()->subMonth())
    //                  ->max('codigo');
    // }

    //
    // Al hacer esto siempre que usemos el modelo ORDENTRABAJO hay que incluir el campo "estado_id"
    //
    // public function miAsterisco(): Attribute
    // {
    //     $aux = " ";
    //     if($this->attributes['estado_id'] == 2) {
    //         $aux = "*";
    //     }

    //     return new Attribute(
    //         get: fn () => "{$aux}",
    //     );
    // }

    // public function miEstado(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => substr($this->attributes['estado_nombre'],0,1),
    //     );
    // }

    // public function letraEstado(): Attribute
    // {
    //     // function (Closure $set, Closure $get) {
    //     // get: fn() => "{$this->attributes['calle_nombre']}  Nº {$this->attributes['calle_numero']}",

    //     // return new Attribute(
    //     //     get: function () {
    //     //         substr($this->attributes['estado_nombre'],0,1);
    //     //     }
    //     // );
        
    //     try {
    //         $aux='';
    //         if ($this->attributes['estado_nombre']) {
    //             $aux = substr($this->attributes['estado_nombre'], 0, 1);
    //         }
    //         return new Attribute(
    //             get: fn () => "{$aux}",
    //         );
    //     } catch (Throwable $e) {
            
    //     }
    // }


    //
    // Al hacer esto siempre que usemos el modelo ORDENTRABAJO hay que incluir el campo "estado_id"
    //
    

    // public function direccion(): Attribute
    // {
    //     return new Attribute(
    //         get: fn() => "{$this->attributes['calle_nombre']}  Nº {$this->attributes['calle_numero']}",
    //     );
    // }

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cliente_id','id')->withDefault();
    }

    public function estado() {
        return $this->belongsTo(Estado::class)->withDefault();
    }

    public function corte() {
        return $this->belongsTo(Corte::class)->withDefault();
    }
    public function tratado() {
        return $this->belongsTo(Tratado::class)->withDefault();
    }
    public function bolsa() {
        return $this->belongsTo(Bolsa::class)->withDefault();
    }
    public function color() {
        return $this->belongsTo(Color::class)->withDefault();
    }
    public function material() {
        return $this->belongsTo(Material::class)->withDefault();
    }
}
