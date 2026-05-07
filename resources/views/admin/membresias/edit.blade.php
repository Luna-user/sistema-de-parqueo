@extends('adminlte::page')
@section('title', 'Editar Membresía')
@section('content_header')
<h1>Editar Membresía</h1>
@stop
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-success">
            <div class="card-header"><h3 class="card-title">Actualizar Membresía</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.membresias.update', $membresia->id_membresia) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Vehículo <span class="text-danger">*</span></label>
                                <select name="vehiculo_id" class="form-control select2" required>
                                    @foreach ($vehiculos as $v)
                                    <option value="{{ $v->id_vehiculo }}" {{ $membresia->vehiculo_id == $v->id_vehiculo ? 'selected' : '' }}>
                                        {{ $v->placa }} — {{ $v->cliente->nombres ?? '?' }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo de Membresía</label>
                                <select name="tipo_membresia_id" class="form-control" required>
                                    @foreach ($tipoMembresias as $t)
                                    <option value="{{ $t->id_tipo_membresia }}" {{ $membresia->tipo_membresia_id == $t->id_tipo_membresia ? 'selected' : '' }}>
                                        {{ $t->nombre ?? 'Sin nombre' }} — ${{ number_format($t->costo, 2) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha Inicio</label>
                                <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $membresia->fecha_inicio) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha Fin</label>
                                <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $membresia->fecha_fin) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="estado" class="form-control" required>
                                    @foreach (['Activa','Vencida','Suspendida'] as $e)
                                    <option value="{{ $e }}" {{ $membresia->estado == $e ? 'selected' : '' }}>{{ $e }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('admin.membresias.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
