<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolsa extends Model
{
    use HasFactory;

    // protected $table = 'tratados';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'fuelle',
        'orden'
    ];

    public function scopeNombre($query, $id)
    {
        $nombre = Bolsa::select('nombre')->find($id);

        return $nombre->nombre;
    }
}
