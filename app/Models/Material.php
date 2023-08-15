<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'orden',
    ];

    public function scopeNombre($query, $id)
    {
        $nombre = Material::select('nombre')->find($id);

        return $nombre->nombre;
    }
}
