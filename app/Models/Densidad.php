<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Densidad extends Model
{
    use HasFactory;

    protected $table = 'densidades';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'detalle',
        'pesoespecifico',
        'min',
        'max',
    ];

    public function scopeNombre($query, $id)
    {
        $nombre = Densidad::select('nombre')->find($id);

        return $nombre->nombre;
    }
}
