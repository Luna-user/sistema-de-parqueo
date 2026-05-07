@extends('adminlte::page')

@section('title', 'Nuevo Tipo de Vehículo')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0">Nuevo Tipo de Vehículo</h1></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.tipo_vehiculos.index') }}">Tipos de Vehículos</a></li>
                <li class="breadcrumb-item active">Nuevo</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header"><h3 class="card-title">Registrar Tipo de Vehículo</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.tipo_vehiculos.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre') }}" placeholder="Ej: Auto, Moto, Camión" required>
                        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3" placeholder="Descripción opcional">{{ old('descripcion') }}</textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.tipo_vehiculos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
