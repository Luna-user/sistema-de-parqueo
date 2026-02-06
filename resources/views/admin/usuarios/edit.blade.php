@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"><b>Edición del Usuario: {{ $usuario->name }}</b></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/usuarios') }}">Listado de Usuarios</a>
                </li>
                <li class="breadcrumb-item active">Edición de Usuario
                    
                </li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<form action="{{ url('/admin/usuario/'.$usuario->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                {{-- Header --}}
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los Campos del Formulario</b></h3>
                </div>

                {{-- Body --}}
                <div class="card-body">
                    <div class="row">
                        {{-- Rol --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="rol">Roles</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <select name="rol" class="form-control" id="rol">
                                        <option value="">Seleccione un Rol</option>
                                        @foreach ($roles as $role)
                                            @if ($role->name !== 'SUPER ADMIN')
                                                <option value="{{ $role->name }}" {{ old('rol', $usuario->roles->pluck('name')->implode(', ')) == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('rol')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Nombres --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombres">Nombres</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="nombres" id="nombres" value="{{ old('nombres', $usuario->nombres) }}" placeholder="Nombres" required>
                                </div>
                                @error('nombres')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Apellidos --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{ old('apellidos', $usuario->apellidos) }}" placeholder="Apellidos" required>
                                </div>
                                @error('apellidos')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $usuario->email) }}" placeholder="Correo Electrónico" required>
                                </div>
                                @error('email')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Tipo Documento --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tipo_documento">Tipo de Documento</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <select class="form-control" name="tipo_documento" id="tipo_documento" required>
                                        <option value="">Seleccione...</option>
                                        <option value="DNI" {{ old('tipo_documento', $usuario->tipo_documento) == 'DNI' ? 'selected' : '' }}>DNI</option>
                                        <option value="RUC" {{ old('tipo_documento', $usuario->tipo_documento) == 'RUC' ? 'selected' : '' }}>RUC</option>
                                        <option value="CI" {{ old('tipo_documento', $usuario->tipo_documento) == 'CI' ? 'selected' : '' }}>CI</option>
                                    </select>
                                </div>
                                @error('tipo_documento')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Nro Documento --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nro_documento">N° Documento</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="nro_documento" id="nro_documento" value="{{ old('nro_documento', $usuario->nro_documento) }}" placeholder="N° Documento" required>
                                </div>
                                @error('nro_documento')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Telefono --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono', $usuario->telefono) }}" placeholder="Teléfono" required>
                                </div>
                                @error('telefono')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Fecha Nacimiento --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento) }}" required>
                                </div>
                                @error('fecha_nacimiento')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Genero --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="genero">Género</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                    </div>
                                    <select class="form-control" name="genero" id="genero" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Masculino" {{ old('genero', $usuario->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Femenino" {{ old('genero', $usuario->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Otro" {{ old('genero', $usuario->genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>
                                @error('genero')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Direccion --}}
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="direccion">Dirección</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion', $usuario->direccion) }}" placeholder="Dirección" required>
                                </div>
                                @error('direccion')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>

    {{-- Sección Contactos de Emergencia --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Contactos de Emergencia</b></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contacto_nombre">Nombre del Contacto</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="contacto_nombre" id="contacto_nombre" value="{{ old('contacto_nombre', $usuario->contacto_nombre) }}" placeholder="Nombre del Contacto" required>
                                </div>
                                @error('contacto_nombre')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contacto_telefono">Teléfono del Contacto</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="contacto_telefono" id="contacto_telefono" value="{{ old('contacto_telefono', $usuario->contacto_telefono) }}" placeholder="Teléfono del Contacto" required>
                                </div>
                                @error('contacto_telefono')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contacto_parentesco">Relación del Contacto</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="contacto_parentesco" id="contacto_parentesco" value="{{ old('contacto_parentesco', $usuario->contacto_parentesco) }}" placeholder="Relación del Contacto" required>
                                </div>
                                @error('contacto_parentesco')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    
    {{-- Botones de Acción --}}
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-circle-left"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Actualizar
            </button>
        </div>
    </div>
</form>
@stop

@section('css')
    {{-- Estilos personalizados --}}
@stop

@section('js')
    <script> console.log("Formulario de registro cargado correctamente."); </script>
@stop