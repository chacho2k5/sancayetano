<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    use HasFactory;

    // protected $table = 'tratados';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function scopeNombre($query, $id)
    {
        $nombre = Corte::select('nombre')->find($id);

        return $nombre->nombre;
    }
}
