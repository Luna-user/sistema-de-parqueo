<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy(function($permission) {
            $parts = explode(' ', $permission->name);
            return count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : 'otros';
        });
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);
        
        $rol = new Role();
        $rol->name = strtoupper($request->name);
        $rol->save();

        if ($request->has('permissions')) {
            $rol->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.roles.index')
        ->with('mensaje', 'Rol Registrado Exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->groupBy(function($permission) {
            $parts = explode(' ', $permission->name);
            return count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : 'otros';
        });
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$id,
            'permissions' => 'nullable|array',
        ]);
        
        $rol = Role::findOrFail($id);
        $rol->name = strtoupper($request->name);
        $rol->save();

        if ($request->has('permissions')) {
            $rol->syncPermissions($request->permissions);
        } else {
            $rol->syncPermissions([]);
        }

        return redirect()->route('admin.roles.index')
        ->with('mensaje', 'Rol Modificado Exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Role::findOrFail($id);
        $rol->delete();

        return redirect()->route('admin.roles.index')
        ->with('mensaje', 'Rol Eliminado Exitosamente.')
        ->with('icono', 'success');
    }
}
