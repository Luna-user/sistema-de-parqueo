@extends('adminlte::page')
@section('title', 'Nuevo Tipo de Membresía')
@section('content_header')
<h1>Nuevo Tipo de Membresía</h1>
@stop
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-outline card-warning">
            <div class="card-header"><h3 class="card-title">Registrar Tipo de Membresía</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.tipo_membresias.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nombre <small class="text-muted">(opcional)</small></label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej: Mensual, Semanal">
                    </div>
                    <div class="form-group">
                        <label>Costo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="number" step="0.01" min="0" name="costo" class="form-control @error('costo') is-invalid @enderror"
                                value="{{ old('costo') }}" required>
                            @error('costo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.tipo_membresias.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
