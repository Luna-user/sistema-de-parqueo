<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    protected $table = 'ajustes';
    protected $fillable = [
        'nombre',
        'descripcion',
        'sucursal',
        'direccion',
        'telefono',
        'logo',
        'logo_auto',
        'divisa',
        'correo_electronico',
        'pagina_web',
    ];
}
