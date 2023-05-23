<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuraciones extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'formula_valor_1',
        'formula_valor_2',
        'estado_inicio',
        'estado_para_planchar'
    ];
}
