<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratado extends Model
{
    use HasFactory;

    // protected $table = 'tratados';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'detalle',
    ];

    public function scopeNombre($query, $id)
    {
        $nombre = Tratado::select('nombre')->find($id);

        return $nombre->nombre;
    }
}
