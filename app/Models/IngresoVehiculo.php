<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IngresoVehiculo extends Model
{
    protected $table = 'ingreso_vehiculos';
    protected $primaryKey = 'id_ingreso';

    protected $fillable = [
        'fecha_ingreso',
        'hora_ingreso',
        'tiene_membresia',
        'vehiculo_id',
        'espacio_id',
        'membresia_id',
    ];

    protected $casts = [
        'fecha_ingreso'   => 'date',
        'tiene_membresia' => 'boolean',
    ];

    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id', 'id_vehiculo');
    }

    public function espacio(): BelongsTo
    {
        return $this->belongsTo(Espacio::class, 'espacio_id', 'id_espacio');
    }

    public function membresia(): BelongsTo
    {
        return $this->belongsTo(Membresia::class, 'membresia_id', 'id_membresia');
    }

    public function salida(): HasOne
    {
        return $this->hasOne(SalidaVehiculo::class, 'ingreso_id', 'id_ingreso');
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class, 'ingreso_id', 'id_ingreso');
    }
}
