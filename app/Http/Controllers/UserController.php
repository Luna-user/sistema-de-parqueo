<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroUsuarioMail;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'SUPER ADMIN');
        })->withTrashed()->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rol' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_documento' => 'required|in:DNI,CARNET DE EXTRANJERIA,PASAPORTE,RUC,CI',
            'nro_documento' => 'required|string|max:20|unique:users',
            'telefono' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'direccion' => 'required|string|max:255',
            'contacto_nombre' => 'required|string|max:255',
            'contacto_telefono' => 'required|string|max:20',
            'contacto_parentesco' => 'required|string|max:100',
        ]);

        $passwordTemporal = Str::random(8);

        $usuario = new User();
        $usuario->name = $request->nombres . ' ' . $request->apellidos;
        $usuario->email = $request->email;
        $usuario->password = $passwordTemporal;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->tipo_documento = $request->tipo_documento;
        $usuario->nro_documento = $request->nro_documento;
        $usuario->telefono = $request->telefono;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->genero = $request->genero;
        $usuario->direccion = $request->direccion;
        $usuario->contacto_nombre = $request->contacto_nombre;
        $usuario->contacto_telefono = $request->contacto_telefono;
        $usuario->contacto_parentesco = $request->contacto_parentesco;

        $usuario->save();

        Mail::to($usuario->email)->send(new RegistroUsuarioMail($usuario, $passwordTemporal));

        $usuario->assignRole($request->rol);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario registrado exitosamente y contraseña temporal enviada al correo electrónico')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        $request->validate([
            'rol' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_documento' => 'required|in:DNI,CARNET DE EXTRANJERIA,PASAPORTE,RUC,CI',
            'nro_documento' => 'required|string|max:20|unique:users,nro_documento,'.$id,
            'telefono' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'direccion' => 'required|string|max:255',
            'contacto_nombre' => 'required|string|max:255',
            'contacto_telefono' => 'required|string|max:20',
            'contacto_parentesco' => 'required|string|max:100',
        ]);

        $usuario->name = $request->nombres . ' ' . $request->apellidos;
        $usuario->email = $request->email;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->tipo_documento = $request->tipo_documento;
        $usuario->nro_documento = $request->nro_documento;
        $usuario->telefono = $request->telefono;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->genero = $request->genero;
        $usuario->direccion = $request->direccion;
        $usuario->contacto_nombre = $request->contacto_nombre;
        $usuario->contacto_telefono = $request->contacto_telefono;
        $usuario->contacto_parentesco = $request->contacto_parentesco;

        $usuario->save();

        $usuario->syncRoles($request->rol);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario actualizado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        //verificar que no sea el mismo usuario logueado
        if ($usuario->id == Auth::user()->id) {
            return redirect()->back()
                ->with('mensaje', 'No puedes eliminar tu propia cuenta.')
                ->with('icono', 'error');
        }else{
            $usuario->estado = false;
            $usuario->save();
            $usuario->delete();
            return redirect()->route('admin.usuarios.index')
                ->with('mensaje', 'Usuario eliminado exitosamente')
                ->with('icono', 'success');
        }
    }

    public function restore($id)
    {
        $usuario = User::withTrashed()->find($id);
        $usuario->restore();
        $usuario->estado = true;
        $usuario->save();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario restaurado exitosamente')
            ->with('icono', 'success');
    }
}
