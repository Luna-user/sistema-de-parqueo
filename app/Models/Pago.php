<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'monto',
        'fecha_pago',
        'metodo_id',
        'membresia_id',
        'ingreso_id',
    ];

    protected $casts = [
        'monto'      => 'decimal:2',
        'fecha_pago' => 'date',
    ];

    public function metodoPago(): BelongsTo
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_id', 'id_metodo');
    }

    public function membresia(): BelongsTo
    {
        return $this->belongsTo(Membresia::class, 'membresia_id', 'id_membresia');
    }

    public function ingreso(): BelongsTo
    {
        return $this->belongsTo(IngresoVehiculo::class, 'ingreso_id', 'id_ingreso');
    }
}
