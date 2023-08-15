<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    use HasFactory;

    // protected $table = 'tratados';
    public $timestamps = false;

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'cliente_id',
        'observaciones',
        'cerrado'
    ];

    public function scopeGetReclamosEstado($query, $cliente, $value)
    {
        // value = true -> devuelve Reclamos cerrados
        // value = false -> devuelve Reclamos abiertos

        $db = Reclamo::query()
            ->where('cliente_id', $cliente)
            ->where('cerrado', $value)
            ->count();

        return $db;
    }

    public function scopeGetReclamosCliente($query, $cliente)
    {
        // Devuelve si el cliente tiene algun reclamo abierto/cerrado

        $db = Reclamo::query()
            ->where('cliente_id', $cliente)
            ->count();

        return $db;
    }

    // public function scopeGetClienteId($query, $value)
    // {
    //     $db = Pedido::find($value);

    //     return $db->cliente_id;
    // }

    // public function scopeUltimaOt($query, $mes)
    // {
    //     $aux = Pedido::whereMonth('fecha_pedido',$mes)->count();
    //     if ($aux == 0) {
    //         return $aux;
    //     } else {
    //         return $query->whereMonth('fecha_pedido',$mes)
    //                         ->max('numero_ot_mensual');
    //     }
    // }

}
