<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = [
        'espacio_id',
        'cliente_id',
        'vehiculo_id',
        'tarifa_id',
        'usuario_id',
        'codigo_ticket',
        'fecha_ingreso',
        'hora_ingreso',
        'fecha_salida',
        'hora_salida',
        'tiempo_total',
        'monto_total',
        'estado_ticket',
        'obs',
    ];

    public function espacio()
    {
        return $this->belongsTo(Espacio::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function tarifa()
    {
        return $this->belongsTo(Tarifa::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
