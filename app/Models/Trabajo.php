<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'fecha_pedido',
        'numero_ot',
        'fecha_entrega',
        'cliente_id',
        'razonsocial',
        'estado_id',
        'estado_nombre',
        'estado_fecha',
        // 'mes_id',
        // 'mes',
        'trabajo_nombre',
        'ancho',
        'largo',
        'espesor',
        'material_id',
        'material_nombre',
        'material_pesoespecifico',
        'color_id',
        'color_nombre',
        'color_id_1',
        'color_nombre_1',
        'color_id_2',
        'color_nombre_2',
        'color_id_3',
        'color_nombre_3',
        'color_id_4',
        'color_nombre_4',
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
        'trabajo_activo',
        'reclamo',
        'reclamo_detalle',
        'observaciones',
        'observaciones_extrusion',
        'observaciones_impresion',
        'observaciones_corte',
    ];

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
