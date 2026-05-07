<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehiculo extends Model
{
    use SoftDeletes;

    protected $table = 'vehiculos';
    protected $primaryKey = 'id_vehiculo';

    protected $fillable = [
        'placa',
        'color',
        'marca',
        'modelo',
        'cliente_id',
        'tipo_vehiculo_id',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id_cliente');
    }

    public function tipoVehiculo(): BelongsTo
    {
        return $this->belongsTo(TipoVehiculo::class, 'tipo_vehiculo_id', 'id_tipo_vehiculo');
    }

    public function membresias(): HasMany
    {
        return $this->hasMany(Membresia::class, 'vehiculo_id', 'id_vehiculo');
    }

    public function ingresos(): HasMany
    {
        return $this->hasMany(IngresoVehiculo::class, 'vehiculo_id', 'id_vehiculo');
    }
}
