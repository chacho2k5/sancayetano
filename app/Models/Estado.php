<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

        // protected $table = 'tratados';
        public $timestamps = false;

        protected $fillable = [
            'orden',
            'nombre',
        ];

        public function scopeGetNombreEstado($query, $id)
        {
            $db = Estado::select('nombre')->find($id);

            return $db->nombre;
        }
}
