<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalidaVehiculo extends Model
{
    protected $table = 'salida_vehiculos';
    protected $primaryKey = 'id_salida';

    protected $fillable = [
        'fecha_salida',
        'hora_salida',
        'ingreso_id',
    ];

    protected $casts = ['fecha_salida' => 'date'];

    public function ingreso(): BelongsTo
    {
        return $this->belongsTo(IngresoVehiculo::class, 'ingreso_id', 'id_ingreso');
    }
}
