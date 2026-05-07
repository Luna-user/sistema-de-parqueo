@extends('adminlte::page')
@section('title', 'Nuevo Método de Pago')
@section('content_header')<h1>Nuevo Método de Pago</h1>@stop
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card card-outline card-success">
            <div class="card-header"><h3 class="card-title">Registrar Método de Pago</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.metodo_pagos.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre') }}" placeholder="Ej: Efectivo, QR, Tarjeta" required>
                        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.metodo_pagos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
