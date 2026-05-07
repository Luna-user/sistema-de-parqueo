<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membresia extends Model
{
    protected $table = 'membresias';
    protected $primaryKey = 'id_membresia';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'vehiculo_id',
        'tipo_membresia_id',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin'    => 'date',
    ];

    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id', 'id_vehiculo');
    }

    public function tipoMembresia(): BelongsTo
    {
        return $this->belongsTo(TipoMembresia::class, 'tipo_membresia_id', 'id_tipo_membresia');
    }

    public function ingresos(): HasMany
    {
        return $this->hasMany(IngresoVehiculo::class, 'membresia_id', 'id_membresia');
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class, 'membresia_id', 'id_membresia');
    }
}
