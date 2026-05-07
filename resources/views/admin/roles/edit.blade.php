@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Modificar Rol</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">Listado de Roles</a>
                </li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">

            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Modificar Rol y Asignar Permisos</b></h3>
            </div>
            {{-- Body --}}
            <div class="card-body">
                <form action="{{ url('/admin/rol/' . $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre del Rol</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-shield"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ old('name', $role->name) }}" name="name" 
                                        placeholder="Ingrese el rol" required>
                                </div>
                                @error('name')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5 class="mb-3"><b>Asignar Permisos por Módulo</b></h5>
                    
                    <div class="row">
                        @foreach($permissions as $module => $modulePermissions)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 shadow-sm border-light">
                                <div class="card-header bg-light py-2">
                                    <h6 class="mb-0 font-weight-bold text-uppercase text-primary">{{ $module }}</h6>
                                </div>
                                <div class="card-body py-2">
                                    @foreach($modulePermissions as $permission)
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" 
                                               name="permissions[]" 
                                               value="{{ $permission->name }}" 
                                               class="custom-control-input" 
                                               id="perm_{{ $permission->id }}"
                                               {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-normal" for="perm_{{ $permission->id }}">
                                            {{ explode(' ', $permission->name)[0] }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="{{ url('/admin/roles') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-circle-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>       
            </div>
        </div>
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