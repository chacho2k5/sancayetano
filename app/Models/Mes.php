<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mes extends Model
{
    use HasFactory;

        protected $table = 'meses';
        public $timestamps = false;

        protected $fillable = [
            'orden',
            'nombre',
        ];


    // public function zzz(): Attribute
    // {
    //     return new Attribute(
    //         get: fn() => "{$this->attributes['orden']} - {$this->attributes['nombre']}",
    //     );
    // }
}
