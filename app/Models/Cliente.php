<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    // protected $table = 'clientes';
    // public $timestamps = false;

    protected $dateformat = "d-m-Y H:i:s";

    protected $fillable = [
        'razonsocial',
        'contacto',
        'cuit',
        'iva_id',
        'telefono1',
        'telefono2',
        'correo',
        'calle_nombre',
        'calle_numero',
        'codigo_postal',
        'barrio_nombre',
        'localidad_nombre',
        'provincia_id',
        // 'barrio_id',
        // 'localidad_id',
        'fecha_alta',
        'base_tango',
        'cliente_tango',
        'observaciones'
];

    
    // Supuestamente con esto podria mostrar el campo direccion directamente
    // protected $appends = ['direccion'];

    // Usando withDefault(), evita que se rompa la relacion cuando no hay datos que se correspondan y asume un valor x defecto
    public function iva() {
        return $this->belongsTo(Iva::class)->withDefault();
    }

    // public function barrio() {
    //     return $this->belongsTo(Barrio::class)->withDefault();
    // }

    // public function localidad() {
    //     return $this->belongsTo(Localidad::class)->withDefault();
    // }

    public function provincia() {
        return $this->belongsTo(Provincia::class);
    }

    public function ots() {
        return $this->hasMany(Ot::class);
    }

    public function articulos() {
        return $this->hasMany(Articulo::class);
    }

    // public function direccion(): Attribute
    // {
    //     return new Attribute(
    //         get: fn() => "{$this->attributes['calle_nombre']}  Nº {$this->attributes['calle_numero']}",
    //     );
    // }

}
