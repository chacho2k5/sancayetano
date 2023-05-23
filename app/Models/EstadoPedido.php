<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPedido extends Model
{
    use HasFactory;

    // protected $table = 'tratados';
    //  public $timestamps = false;

    protected $fillable = [
        'pedido_id',
        'estado_id',
        'fecha_inicio',
        'fecha_final',
        'observaciones',
    ];
}
