<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    // protected $table = 'empleados';
    // public $timestamps = false;

    protected $fillable = [
        'apellido',
        'nombres',
        'documento_numero',
        'telefono',
        'correo',
        'calle_nombre',
        'calle_numero',
        'codigo_postal',
        'barrio_nombre',
        'localidad_nombre',
        'provincia_id',
        'fecha_alta',
        'observaciones',
    ];
}
