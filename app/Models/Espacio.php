<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Espacio extends Model
{
    protected $table = 'espacios';
    protected $primaryKey = 'id_espacio';

    protected $fillable = ['numero', 'estado'];

    public function ingresos(): HasMany
    {
        return $this->hasMany(IngresoVehiculo::class, 'espacio_id', 'id_espacio');
    }
}
