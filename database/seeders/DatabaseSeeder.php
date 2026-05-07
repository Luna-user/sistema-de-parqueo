<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Ajuste;
use App\Models\User;
use App\Models\Espacio;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\TipoVehiculo;
use App\Models\TipoMembresia;
use App\Models\MetodoPago;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Roles
        $this->call(RoleSeeder::class);

        // ── Ajustes del sistema ────────────────────────────────────────────
        Ajuste::create([
            'nombre'             => 'Sistema de Parqueo Av. Bush',
            'descripcion'        => 'Sistema de Gestión de Parqueo',
            'sucursal'           => 'SC',
            'direccion'          => 'Zona Bush',
            'telefono'           => '75048574',
            'logo'               => 'roThAIxXBG4VF7r8PjCrCdjbcEqqgJ6o0wqrwomc.jpg',
            'logo_auto'          => 'l9SStN0PbgDvqwgKSWmJYhIz9t7aWLbMrmmAPUMS.jpg',
            'divisa'             => 'Bs',
            'correo_electronico' => 'silviaojeda980@gmail.com',
            'pagina_web'         => 'https://goti.com',
        ]);

        // ── Usuarios ───────────────────────────────────────────────────────
        // Super Admin
        User::create([
            'name'                 => 'Super Admin',
            'email'                => 'superadmin@gmail.com',
            'contraseña'           => Hash::make('12345678'),
            'nombres'              => 'Super',
            'apellidos'            => 'Admin',
            'tipo_documento'       => 'CI',
            'nro_documento'        => '12345678',
            'telefono'             => '75048574',
            'fecha_nacimiento'     => '2000-01-01',
            'genero'               => 'Masculino',
            'direccion'            => 'Dirección del Super Admin',
            'contacto_nombre'      => 'Contacto del Super Admin',
            'contacto_telefono'    => '75048574',
            'contacto_parentesco'  => 'Padre',
            'estado'               => true,
        ])->assignRole('SUPER ADMIN');

        // Administrador
        User::create([
            'name'                 => 'Herbert Luna Ojeda',
            'email'                => 'administrador@gmail.com',
            'contraseña'           => Hash::make('12345678'),
            'nombres'              => 'Herbert',
            'apellidos'            => 'Luna Ojeda',
            'tipo_documento'       => 'CI',
            'nro_documento'        => '11321192',
            'telefono'             => '75048574',
            'fecha_nacimiento'     => '2006-05-01',
            'genero'               => 'Masculino',
            'direccion'            => 'El Torno Puerto Rico',
            'contacto_nombre'      => 'Silvia Ojeda',
            'contacto_telefono'    => '63582529',
            'contacto_parentesco'  => 'Madre',
            'estado'               => true,
        ])->assignRole('ADMINISTRADOR');

        // Operador
        User::create([
            'name'                 => 'Yasser Nabil Luna Ojeda',
            'email'                => 'operador@gmail.com',
            'contraseña'           => Hash::make('12345678'),
            'nombres'              => 'Yasser Nabil',
            'apellidos'            => 'Luna Ojeda',
            'tipo_documento'       => 'CI',
            'nro_documento'        => '11321191',
            'telefono'             => '69251069',
            'fecha_nacimiento'     => '2004-12-11',
            'genero'               => 'Masculino',
            'direccion'            => 'El Torno Puerto Rico',
            'contacto_nombre'      => 'Silvia Ojeda',
            'contacto_telefono'    => '63582529',
            'contacto_parentesco'  => 'Madre',
            'estado'               => true,
        ])->assignRole('OPERADOR');

        // ── Tipos de Vehículos ─────────────────────────────────────────────
        $tipoAuto  = TipoVehiculo::create(['nombre' => 'Auto',  'descripcion' => 'Vehículo de 4 ruedas']);
        $tipoMoto  = TipoVehiculo::create(['nombre' => 'Moto',  'descripcion' => 'Motocicleta']);
        $tipoCamio = TipoVehiculo::create(['nombre' => 'Camión','descripcion' => 'Vehículo de carga']);

        // ── Tipos de Membresías ────────────────────────────────────────────
        TipoMembresia::create(['nombre' => 'Mensual',  'costo' => 200.00]);
        TipoMembresia::create(['nombre' => 'Semanal',  'costo' => 60.00]);
        TipoMembresia::create(['nombre' => 'Diaria',   'costo' => 10.00]);

        // ── Métodos de Pago ────────────────────────────────────────────────
        MetodoPago::create(['nombre' => 'Efectivo']);
        MetodoPago::create(['nombre' => 'Tarjeta']);
        MetodoPago::create(['nombre' => 'QR / Transferencia']);

        // ── Espacios de Parqueo (40 espacios) ─────────────────────────────
        for ($i = 1; $i <= 40; $i++) {
            Espacio::create(['numero' => (string) $i, 'estado' => 'Disponible']);
        }

        // ── Clientes y Vehículos ───────────────────────────────────────────
        $cliente1 = Cliente::create([
            'nombres'          => 'Juan Daniel Villagomez',
            'numero_documento' => '12345678',
            'email'            => 'juan@gmail.com',
            'telefono'         => '75048080',
            'genero'           => 'Masculino',
            'estado'           => true,
        ]);
        Vehiculo::create([
            'cliente_id'       => $cliente1->id_cliente,
            'tipo_vehiculo_id' => $tipoAuto->id_tipo_vehiculo,
            'placa'            => 'ABC-123',
            'marca'            => 'Toyota',
            'modelo'           => 'Corolla',
            'color'            => 'Blanco',
        ]);

        $cliente2 = Cliente::create([
            'nombres'          => 'Maria Fernanda',
            'numero_documento' => '87654321',
            'email'            => 'maria@gmail.com',
            'telefono'         => '75048081',
            'genero'           => 'Femenino',
            'estado'           => true,
        ]);
        Vehiculo::create([
            'cliente_id'       => $cliente2->id_cliente,
            'tipo_vehiculo_id' => $tipoAuto->id_tipo_vehiculo,
            'placa'            => 'XYZ-789',
            'marca'            => 'Honda',
            'modelo'           => 'Civic',
            'color'            => 'Rojo',
        ]);

        $cliente3 = Cliente::create([
            'nombres'          => 'Pedro Jose',
            'numero_documento' => '12311199',
            'email'            => 'pedro@gmail.com',
            'telefono'         => '75048082',
            'genero'           => 'Masculino',
            'estado'           => true,
        ]);
        Vehiculo::create([
            'cliente_id'       => $cliente3->id_cliente,
            'tipo_vehiculo_id' => $tipoAuto->id_tipo_vehiculo,
            'placa'            => 'DEF-456',
            'marca'            => 'Nissan',
            'modelo'           => 'Sentra',
            'color'            => 'Azul',
        ]);

        $cliente4 = Cliente::create([
            'nombres'          => 'Ana Maria',
            'numero_documento' => '87654333',
            'email'            => 'ana@gmail.com',
            'telefono'         => '75048083',
            'genero'           => 'Femenino',
            'estado'           => true,
        ]);
        Vehiculo::create([
            'cliente_id'       => $cliente4->id_cliente,
            'tipo_vehiculo_id' => $tipoAuto->id_tipo_vehiculo,
            'placa'            => 'GHI-123',
            'marca'            => 'Kia',
            'modelo'           => 'Picanto',
            'color'            => 'Blanco',
        ]);

        $cliente5 = Cliente::create([
            'nombres'          => 'Luis Fernando',
            'numero_documento' => '12349131',
            'email'            => 'luis@gmail.com',
            'telefono'         => '75048084',
            'genero'           => 'Masculino',
            'estado'           => true,
        ]);
        Vehiculo::create([
            'cliente_id'       => $cliente5->id_cliente,
            'tipo_vehiculo_id' => $tipoMoto->id_tipo_vehiculo,
            'placa'            => 'JKL-456',
            'marca'            => 'Yamaha',
            'modelo'           => 'MT-07',
            'color'            => 'Negro',
        ]);
    }
}