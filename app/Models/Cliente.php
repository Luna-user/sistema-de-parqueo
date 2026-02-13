<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table = 'clientes';
    protected $fillable = [
        'nombres',
        'numero_documento',
        'email',
        'telefono',
        'genero',
        'estado',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }
}
