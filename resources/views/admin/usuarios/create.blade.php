@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Registro de un Nuevo Usuario</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/usuarios') }}">Listado de Usuarios</a>
                </li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Llene los Campos del Formulario</b></h3>
            </div>
            {{-- Body --}}
            <div class="card-body">
                <form action="{{ url('/admin/usuarios/create') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Roles</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-check"></i>
                                        </span>
                                    </div>
                                    <select name="rol" class="form-control" id="" >
                                        <option value="">Seleccione un Rol</option>
                                        @foreach ($roles as $role)
                                            @if (!($role->name == 'SUPER ADMIN'))
                                                <option value="{{ $role->name }}"
                                                    {{ old('rol') == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('rol')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombres</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="nombres" id="nombres"
                                        value="{{ old('nombres') }}"  placeholder="Nombres" required>
                                </div>
                                @error('nombres')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Apellidos</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos"
                                        value="{{ old('apellidos') }}"  placeholder="Apellidos" required>
                                </div>
                                @error('apellidos')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Correo Electronico</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="{{ old('email') }}"  placeholder="Correo Electronico" required>
                                </div>
                                @error('email')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tipo de Documento</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                    <select class="form-control" name="tipo_documento" id="tipo_documento" required>
                                        <option value="">Seleccione...</option>
                                        <option value="DNI"{{ old('tipo_documento') == 'DNI' ? 'selected' : '' }}>DNI</option>
                                        <option value="RUC"{{ old('tipo_documento') == 'RUC' ? 'selected' : '' }}>RUC</option>
                                        <option value="CI"{{ old('tipo_documento') == 'CI' ? 'selected' : '' }}>CI</option>
                                    </select>
                                </div>
                                @error('tipo_documento')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">N° Documento</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="num_documento" id="num_documento"
                                        value="{{ old('num_documento') }}"  placeholder="N° Documento" required>
                                </div>
                                @error('num_documento')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Telefono</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="telefono" id="telefono"
                                        value="{{ old('telefono') }}"  placeholder="Telefono" required>
                                </div>
                                @error('telefono')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Fecha de Nacimiento</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento"
                                        value="{{ old('fecha_nacimiento') }}"  placeholder="Fecha de Nacimiento" required>
                                </div>
                                @error('fecha_nacimiento')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Genero</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-venus-mars"></i>
                                        </span>
                                    </div>
                                    <select class="form-control" name="genero" id="genero" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Masculino"{{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Femenino"{{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Otro"{{ old('genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>
                                @error('genero')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Direccion</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="direccion" id="direccion"
                                        value="{{ old('direccion') }}"  placeholder="Direccion" required>
                                </div>
                                @error('direccion')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>       
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">

            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Contactos de Emergencia</b></h3>
            </div>
            {{-- Body --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nombre del Contacto</label><b> (*)</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-shield"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="nombre_contacto" id="nombre_contacto"
                                    value="{{ old('nombre_contacto') }}"  placeholder="Nombre del Contacto" required>
                            </div>
                            @error('nombre_contacto')
                                    <small style ="color: red;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Telefono del Contacto</label><b> (*)</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="telefono_contacto" id="telefono_contacto"
                                    value="{{ old('telefono_contacto') }}"  placeholder="Telefono del Contacto" required>
                            </div>
                            @error('telefono_contacto')
                                    <small style ="color: red;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Relacion del Contacto</label><b> (*)</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-tie"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="relacion_contacto" id="relacion_contacto"
                                    value="{{ old('relacion_contacto') }}"  placeholder="Relacion del Contacto" required>
                            </div>
                            @error('relacion_contacto')
                                    <small style ="color: red;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-circle-left"></i> Cancelar
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Guardar
        </button>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop