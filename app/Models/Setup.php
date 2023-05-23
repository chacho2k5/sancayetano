<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;

        // protected $table = 'setups';
        public $timestamps = false;

        protected $fillable = [
            'iva1',
            'iva2',
        ];
}
