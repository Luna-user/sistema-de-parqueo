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
    public function index()
    {
        $usuarios = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'SUPER ADMIN');
        })->withTrashed()->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'SUPER ADMIN')->get();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rol'                  => 'required',
            'email'                => 'required|string|email|max:255|unique:users',
            'nombres'              => 'required|string|max:255',
            'apellidos'            => 'required|string|max:255',
            'tipo_documento'       => 'required|in:DNI,CARNET DE EXTRANJERIA,PASAPORTE,RUC,CI',
            'nro_documento'        => 'required|string|max:20|unique:users',
            'telefono'             => 'required|string|max:20',
            'fecha_nacimiento'     => 'required|date',
            'genero'               => 'required|in:Masculino,Femenino,Otro',
            'direccion'            => 'required|string|max:255',
            'contacto_nombre'      => 'required|string|max:255',
            'contacto_telefono'    => 'required|string|max:20',
            'contacto_parentesco'  => 'required|string|max:100',
        ]);

        $passwordTemporal = Str::random(8);

        $usuario = User::create([
            'name'                => $request->nombres . ' ' . $request->apellidos,
            'email'               => $request->email,
            'contraseña'          => $passwordTemporal,
            'nombres'             => $request->nombres,
            'apellidos'           => $request->apellidos,
            'tipo_documento'      => $request->tipo_documento,
            'nro_documento'       => $request->nro_documento,
            'telefono'            => $request->telefono,
            'fecha_nacimiento'    => $request->fecha_nacimiento,
            'genero'              => $request->genero,
            'direccion'           => $request->direccion,
            'contacto_nombre'     => $request->contacto_nombre,
            'contacto_telefono'   => $request->contacto_telefono,
            'contacto_parentesco' => $request->contacto_parentesco,
            'estado'              => true,
        ]);

        $usuario->assignRole($request->rol);

        try {
            Mail::to($usuario->email)->send(new RegistroUsuarioMail($usuario, $passwordTemporal));
        } catch (\Exception $e) {
            // No interrumpir si el mail falla
        }

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario registrado y contraseña temporal enviada al correo.')
            ->with('icono', 'success');
    }

    public function show($id)
    {
        $usuario = User::withTrashed()->findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles   = Role::where('name', '!=', 'SUPER ADMIN')->get();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'rol'                  => 'required',
            'email'                => 'required|string|email|max:255|unique:users,email,' . $id . ',id_usuario',
            'nombres'              => 'required|string|max:255',
            'apellidos'            => 'required|string|max:255',
            'tipo_documento'       => 'required|in:DNI,CARNET DE EXTRANJERIA,PASAPORTE,RUC,CI',
            'nro_documento'        => 'required|string|max:20|unique:users,nro_documento,' . $id . ',id_usuario',
            'telefono'             => 'required|string|max:20',
            'fecha_nacimiento'     => 'required|date',
            'genero'               => 'required|in:Masculino,Femenino,Otro',
            'direccion'            => 'required|string|max:255',
            'contacto_nombre'      => 'required|string|max:255',
            'contacto_telefono'    => 'required|string|max:20',
            'contacto_parentesco'  => 'required|string|max:100',
        ]);

        $usuario->update([
            'name'                => $request->nombres . ' ' . $request->apellidos,
            'email'               => $request->email,
            'nombres'             => $request->nombres,
            'apellidos'           => $request->apellidos,
            'tipo_documento'      => $request->tipo_documento,
            'nro_documento'       => $request->nro_documento,
            'telefono'            => $request->telefono,
            'fecha_nacimiento'    => $request->fecha_nacimiento,
            'genero'              => $request->genero,
            'direccion'           => $request->direccion,
            'contacto_nombre'     => $request->contacto_nombre,
            'contacto_telefono'   => $request->contacto_telefono,
            'contacto_parentesco' => $request->contacto_parentesco,
        ]);

        $usuario->syncRoles($request->rol);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario actualizado exitosamente.')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        // Bloquear si intenta eliminarse a sí mismo
        if ($usuario->id_usuario == auth()->id()) {
            return redirect()->route('admin.usuarios.index')
                ->with('mensaje', '¡Error! No puedes eliminar tu propia cuenta de usuario.')
                ->with('icono', 'error');
        }

        // Bloquear si intenta eliminar a un SUPER ADMIN (doble seguridad)
        if ($usuario->hasRole('SUPER ADMIN')) {
            return redirect()->route('admin.usuarios.index')
                ->with('mensaje', 'No se permite eliminar usuarios con el rol SUPER ADMIN.')
                ->with('icono', 'error');
        }

        $usuario->estado = false;
        $usuario->save();
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario eliminado exitosamente.')
            ->with('icono', 'success');
    }

    public function restore($id)
    {
        $usuario = User::withTrashed()->findOrFail($id);
        $usuario->restore();
        $usuario->estado = true;
        $usuario->save();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario restaurado exitosamente.')
            ->with('icono', 'success');
    }
}
