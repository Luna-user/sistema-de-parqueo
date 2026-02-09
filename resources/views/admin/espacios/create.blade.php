@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Registro de un Nuevo Espacio</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/espacios') }}">Listado de Espacios</a>
                </li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">

            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Llene los Campos del Formulario</b></h3>
            </div>
            {{-- Body --}}
            <div class="card-body">
                <form action="{{ url('/admin/espacios/create') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Número del Espacio</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-parking"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="numero"
                                        name="numero" value="{{ old('numero') }}"  
                                        placeholder="Ej: A1, A2, A3, etc." required>
                                </div>
                                @error('numero')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado">Estado</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                    </div>
                                    <select class="form-control" name="estado" id="estado" required>
                                        <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                        <option value="ocupado" {{ old('estado') == 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                                        <option value="mantenimiento" {{ old('estado') == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                    </select>
                                </div>
                                @error('estado')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('/admin/espacios') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-circle-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar
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