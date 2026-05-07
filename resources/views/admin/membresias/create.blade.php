@extends('adminlte::page')
@section('title', 'Nueva Membresía')
@section('content_header')
<h1>Nueva Membresía</h1>
@stop
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-purple">
            <div class="card-header"><h3 class="card-title">Registrar Membresía</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.membresias.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Vehículo <span class="text-danger">*</span></label>
                                <select name="vehiculo_id" class="form-control select2 @error('vehiculo_id') is-invalid @enderror" required>
                                    <option value="">-- Seleccionar vehículo --</option>
                                    @foreach ($vehiculos as $v)
                                    <option value="{{ $v->id_vehiculo }}" {{ old('vehiculo_id') == $v->id_vehiculo ? 'selected' : '' }}>
                                        {{ $v->placa }} — {{ $v->cliente->nombres ?? '?' }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('vehiculo_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo de Membresía <span class="text-danger">*</span></label>
                                <select name="tipo_membresia_id" class="form-control @error('tipo_membresia_id') is-invalid @enderror" required>
                                    <option value="">-- Seleccionar tipo --</option>
                                    @foreach ($tipoMembresias as $t)
                                    <option value="{{ $t->id_tipo_membresia }}" {{ old('tipo_membresia_id') == $t->id_tipo_membresia ? 'selected' : '' }}>
                                        {{ $t->nombre ?? 'Sin nombre' }} — ${{ number_format($t->costo, 2) }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('tipo_membresia_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha Inicio <span class="text-danger">*</span></label>
                                <input type="date" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror"
                                    value="{{ old('fecha_inicio', now()->toDateString()) }}" required>
                                @error('fecha_inicio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha Fin <span class="text-danger">*</span></label>
                                <input type="date" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror"
                                    value="{{ old('fecha_fin') }}" required>
                                @error('fecha_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado <span class="text-danger">*</span></label>
                                <select name="estado" class="form-control" required>
                                    <option value="Activa" {{ old('estado') == 'Activa' ? 'selected' : '' }}>Activa</option>
                                    <option value="Vencida" {{ old('estado') == 'Vencida' ? 'selected' : '' }}>Vencida</option>
                                    <option value="Suspendida" {{ old('estado') == 'Suspendida' ? 'selected' : '' }}>Suspendida</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('admin.membresias.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        <button type="submit" class="btn btn-purple"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
