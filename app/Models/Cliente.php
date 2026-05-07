<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'nombres',
        'numero_documento',
        'email',
        'telefono',
        'genero',
        'estado',
    ];

    public function vehiculos(): HasMany
    {
        return $this->hasMany(Vehiculo::class, 'cliente_id', 'id_cliente');
    }
}
