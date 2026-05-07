@extends('adminlte::page')
@section('title', 'Registrar Pago')
@section('content_header')
<h1>Registrar Pago Manual</h1>
@stop
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-success">
            <div class="card-header"><h3 class="card-title">Nuevo Pago</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.pagos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Monto <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                <input type="number" step="0.01" min="0" name="monto"
                                    class="form-control @error('monto') is-invalid @enderror"
                                    value="{{ old('monto') }}" required>
                                @error('monto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Fecha de Pago <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_pago" class="form-control"
                                value="{{ old('fecha_pago', now()->toDateString()) }}" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Método de Pago <span class="text-danger">*</span></label>
                            <select name="metodo_id" class="form-control @error('metodo_id') is-invalid @enderror" required>
                                <option value="">-- Seleccionar método --</option>
                                @foreach($metodos as $m)
                                <option value="{{ $m->id_metodo }}" {{ old('metodo_id') == $m->id_metodo ? 'selected' : '' }}>
                                    {{ $m->nombre }}
                                </option>
                                @endforeach
                            </select>
                            @error('metodo_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-12">
                            <div class="callout callout-info">
                                <small>Asocie el pago a <strong>una</strong> de las siguientes opciones (o deje ambas vacías para pago genérico):</small>
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Membresía (opcional)</label>
                            <select name="membresia_id" class="form-control select2">
                                <option value="">— Sin membresía —</option>
                                @foreach($membresias as $m)
                                <option value="{{ $m->id_membresia }}" {{ old('membresia_id') == $m->id_membresia ? 'selected' : '' }}>
                                    {{ $m->vehiculo->placa ?? '—' }} — {{ $m->vehiculo->cliente->nombres ?? '—' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Ingreso (opcional)</label>
                            <select name="ingreso_id" class="form-control select2">
                                <option value="">— Sin ingreso —</option>
                                @foreach($ingresos as $i)
                                <option value="{{ $i->id_ingreso }}" {{ old('ingreso_id') == $i->id_ingreso ? 'selected' : '' }}>
                                    {{ $i->vehiculo->placa ?? '—' }} — {{ $i->fecha_ingreso }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('admin.pagos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Registrar Pago</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
