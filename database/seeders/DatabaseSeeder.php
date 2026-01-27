<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Ajuste;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //superAdmin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'nombres' => 'Super',
            'apellidos' => 'Admin',
            'tipo_documento' => 'CI',
            'nro_documento' => '12345678',
            'telefono' => '75048574',
            'fecha_nacimiento' => '2000-01-01',
            'genero' => 'Masculino',
            'direccion' => 'Direccion del Super Admin',
            'contacto_nombre' => 'Contacto del Super Admin',
            'contacto_telefono' => '75048574',
            'contacto_parentesco' => 'Padre',
            'estado' => true,
        ]);

        Ajuste::create([
            'nombre' => 'Sistema de Parqueo Av. Bush',
            'descripcion' => 'Sistema de Gestión de Parqueo',
            'sucursal' => 'SC',
            'direccion' => 'Zona Bush',
            'telefono' => '75048574',
            'logo' => 'roThAIxXBG4VF7r8PjCrCdjbcEqqgJ6o0wqrwomc.jpg',
            'logo_auto' => 'l9SStN0PbgDvqwgKSWmJYhIz9t7aWLbMrmmAPUMS.jpg',
            'divisa' => 'Bs',
            'correo_electronico' => 'silviaojeda980@gmail.com',
            'pagina_web' => 'https://goti.com',
        ]);
    }
}
