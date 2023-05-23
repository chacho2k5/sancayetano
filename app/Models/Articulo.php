<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'nombre',
        'ancho',
        'largo',
        'espesor',
        'material_id',
        'color_id',
        'bolsa_id',
        'fuelle',
        'tratado_id',
        'corte_id',
        'observaciones',
        'activo',
        'trabajo'
    ];
}
