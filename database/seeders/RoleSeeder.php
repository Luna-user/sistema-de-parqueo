<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar caché de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permisos = [
            'ver dashboard',
            
            'ver ajustes', 'editar ajustes',
            
            'ver roles', 'crear roles', 'editar roles', 'eliminar roles',
            
            'ver usuarios', 'crear usuarios', 'editar usuarios', 'eliminar usuarios',
            
            'ver espacios', 'crear espacios', 'editar espacios', 'eliminar espacios',
            
            'ver clientes', 'crear clientes', 'editar clientes', 'eliminar clientes',
            
            'ver vehiculos', 'crear vehiculos', 'editar vehiculos', 'eliminar vehiculos',
            
            'ver tipo vehiculos', 'crear tipo vehiculos', 'editar tipo vehiculos', 'eliminar tipo vehiculos',
            
            'ver tipo membresias', 'crear tipo membresias', 'editar tipo membresias', 'eliminar tipo membresias',
            
            'ver membresias', 'crear membresias', 'editar membresias', 'eliminar membresias',
            
            'ver metodos pago', 'crear metodos pago', 'editar metodos pago', 'eliminar metodos pago',
            
            'ver ingresos', 'crear ingresos', 'eliminar ingresos',
            
            'ver salidas', 'crear salidas',
            
            'ver pagos', 'crear pagos', 'eliminar pagos',
            
            'ver bitacora', 'limpiar bitacora'
        ];

        foreach ($permisos as $permiso) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear Roles
        $superAdmin = Role::firstOrCreate(['name' => 'SUPER ADMIN']);
        $admin = Role::firstOrCreate(['name' => 'ADMINISTRADOR']);
        $operador = Role::firstOrCreate(['name' => 'OPERADOR']);

        // Asignar TODO a SUPER ADMIN y ADMINISTRADOR
        $superAdmin->syncPermissions($permisos);
        $admin->syncPermissions($permisos);

        // Asignar permisos específicos al OPERADOR
        $permisosOperador = [
            'ver dashboard',
            'ver espacios',
            'ver clientes', 'crear clientes', 'editar clientes',
            'ver vehiculos', 'crear vehiculos', 'editar vehiculos',
            'ver membresias', 'crear membresias', 'editar membresias',
            'ver ingresos', 'crear ingresos',
            'ver salidas', 'crear salidas',
            'ver pagos', 'crear pagos',
        ];
        $operador->syncPermissions($permisosOperador);
    }
}
