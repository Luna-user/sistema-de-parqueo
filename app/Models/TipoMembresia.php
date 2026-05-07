<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoMembresia extends Model
{
    protected $table = 'tipo_membresias';
    protected $primaryKey = 'id_tipo_membresia';

    protected $fillable = ['nombre', 'costo'];

    protected $casts = ['costo' => 'decimal:2'];

    public function membresias(): HasMany
    {
        return $this->hasMany(Membresia::class, 'tipo_membresia_id', 'id_tipo_membresia');
    }
}
