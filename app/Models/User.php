<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $primaryKey = 'id_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'contraseña',
        'nombres',
        'apellidos',
        'tipo_documento',
        'nro_documento',
        'telefono',
        'fecha_nacimiento',
        'genero',
        'direccion',
        'foto',
        'contacto_nombre',
        'contacto_telefono',
        'contacto_parentesco',
        'estado',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'contraseña'        => 'hashed',
        ];
    }

    /**
     * Map the 'password' accessor to 'contraseña' for Laravel Auth compatibility.
     */
    public function getAuthPassword(): string
    {
        return $this->contraseña;
    }
}
