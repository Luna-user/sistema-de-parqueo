<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Ajuste;
use App\Models\User;
use App\Models\Espacio;
use App\Models\Tarifa;
use App\Models\Cliente;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RoleSeeder::class);

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
        ])->assignRole('SUPER ADMIN');
        //admin
        User::create([
            'name' => 'Herbert Luna Ojeda',
            'email' => 'administrador@gmail.com',
            'password' => Hash::make('12345678'),
            'nombres' => 'Herbert',
            'apellidos' => 'Luna Ojeda',
            'tipo_documento' => 'CI',
            'nro_documento' => '11321192',
            'telefono' => '75048574',
            'fecha_nacimiento' => '2006-05-01',
            'genero' => 'Masculino',
            'direccion' => 'El Torno Puerto Rico',
            'contacto_nombre' => 'Silvia Ojeda',
            'contacto_telefono' => '63582529',
            'contacto_parentesco' => 'Madre',
            'estado' => true,
        ])->assignRole('ADMINISTRADOR');
        //operador
        User::create([
            'name' => 'Yasser Nabil Luna Ojeda',
            'email' => 'operador@gmail.com',
            'password' => Hash::make('12345678'),
            'nombres' => 'Yasser Nabil',
            'apellidos' => 'Luna Ojeda',
            'tipo_documento' => 'CI',
            'nro_documento' => '11321191',
            'telefono' => '69251069',
            'fecha_nacimiento' => '2004-12-11',
            'genero' => 'Masculino',
            'direccion' => 'El Torno Puerto Rico',
            'contacto_nombre' => 'Silvia Ojeda',
            'contacto_telefono' => '63582529',
            'contacto_parentesco' => 'Madre',
            'estado' => true,
        ])->assignRole('OPERADOR');

        //Espacios de Parqueo
        Espacio::create(['numero' => '1', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '2', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '3', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '4', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '5', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '6', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '7', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '8', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '9', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '10', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '11', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '12', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '13', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '14', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '15', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '16', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '17', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '18', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '19', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '20', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '21', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '22', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '23', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '24', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '25', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '26', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '27', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '28', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '29', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '30', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '31', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '32', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '33', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '34', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '35', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '36', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '37', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '38', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '39', 'estado' => 'Disponible']);
        Espacio::create(['numero' => '40', 'estado' => 'Disponible']);

        //Tarifas
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 1, 'costo' => '5', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 2, 'costo' => '10', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 3, 'costo' => '15', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 4, 'costo' => '20', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 5, 'costo' => '25', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 6, 'costo' => '30', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 7, 'costo' => '35', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 8, 'costo' => '40', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 9, 'costo' => '45', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 10, 'costo' => '50', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 11, 'costo' => '55', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 12, 'costo' => '60', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 13, 'costo' => '65', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 14, 'costo' => '70', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 15, 'costo' => '75', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 16, 'costo' => '80', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 17, 'costo' => '85', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 18, 'costo' => '90', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 19, 'costo' => '95', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 20, 'costo' => '100', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 21, 'costo' => '105', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 22, 'costo' => '110', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 23, 'costo' => '115', 'minutos_de_gracia' => '30']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_hora', 'cantidad' => 24, 'costo' => '120', 'minutos_de_gracia' => '30']);
        
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_dia', 'cantidad' => 1, 'costo' => '50', 'minutos_de_gracia' => '60']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_dia', 'cantidad' => 2, 'costo' => '100', 'minutos_de_gracia' => '60']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_dia', 'cantidad' => 3, 'costo' => '150', 'minutos_de_gracia' => '60']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_dia', 'cantidad' => 4, 'costo' => '200', 'minutos_de_gracia' => '60']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_dia', 'cantidad' => 5, 'costo' => '250', 'minutos_de_gracia' => '60']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_dia', 'cantidad' => 6, 'costo' => '300', 'minutos_de_gracia' => '60']);
        Tarifa::create(['nombre' => 'regular', 'tipo' => 'por_dia', 'cantidad' => 7, 'costo' => '350', 'minutos_de_gracia' => '60']);

        //Clientes
        //cliente1
        Cliente::create([
            'nombres' => 'Juan Daniel Villagomez',
            'numero_documento' => '12345678',
            'email' => 'juan@gmail.com',
            'telefono' => '75048080',
            'genero' => 'Masculino',
            'estado' => true
        ]);
        //cliente2
        Cliente::create([
            'nombres' => 'Maria Fernanda', 
            'numero_documento' => '87654321',
            'email' => 'maria@gmail.com',
            'telefono' => '75048081',
            'genero' => 'Femenino',
            'estado' => true
        ]);
        //cliente3
        Cliente::create([
            'nombres' => 'Pedro Jose',
            'numero_documento' => '12311199',
            'email' => 'pedro@gmail.com',
            'telefono' => '75048082',
            'genero' => 'Masculino',
            'estado' => true
        ]);
        //cliente4
        Cliente::create([
            'nombres' => 'Ana Maria',
            'numero_documento' => '87654333',
            'email' => 'ana@gmail.com',
            'telefono' => '75048083',
            'genero' => 'Femenino',
            'estado' => true
        ]);
        //cliente5
        Cliente::create([
            'nombres' => 'Luis Fernando',
            'numero_documento' => '12349131',
            'email' => 'luis@gmail.com',
            'telefono' => '75048084',
            'genero' => 'Masculino',
            'estado' => true
        ]);
        //cliente6
        Cliente::create([
            'nombres' => 'Sofia Fernanda',
            'numero_documento' => '87654427',
            'email' => 'sofia@gmail.com',
            'telefono' => '75048085',
            'genero' => 'Femenino',
            'estado' => true
        ]);
        //cliente7
        Cliente::create([
            'nombres' => 'Carlos Jose',
            'numero_documento' => '12362315',
            'email' => 'carlos@gmail.com',
            'telefono' => '75048086',
            'genero' => 'Masculino',
            'estado' => true
        ]);
        //cliente8
        Cliente::create([
            'nombres' => 'Laura Fernanda',
            'numero_documento' => '87651654',
            'email' => 'laura@gmail.com',
            'telefono' => '75048087',
            'genero' => 'Femenino',
            'estado' => true
        ]);
        //cliente9
        Cliente::create([
            'nombres' => 'Miguel Jose',
            'numero_documento' => '12345779',
            'email' => 'miguel@gmail.com',
            'telefono' => '75048088',
            'genero' => 'Masculino',
            'estado' => true
        ]);
        //cliente10
        Cliente::create([
            'nombres' => 'Camila Fernanda',
            'numero_documento' => '87654789',
            'email' => 'camila@gmail.com',
            'telefono' => '75048089',
            'genero' => 'Femenino',
            'estado' => true
        ]);
    }
}