<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colores';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function scopeNombre($query, $id)
    {
        $nombre = Color::select('nombre')->find($id);

        return $nombre->nombre;
    }
}
