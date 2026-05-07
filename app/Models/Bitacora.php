<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacoras';
    protected $primaryKey = 'id_bitacora';

    protected $fillable = [
        'accion',
        'tabla_afectada',
        'descripcion',
        'fecha',
        'hora',
    ];

    protected $casts = ['fecha' => 'date'];
}
