@extends('adminlte::page')

@section('title', 'Detalle de Ingreso')

@section('content_header')
    <h1>Detalle del Ingreso #{{ $ingreso->id_ingreso }}</h1>
@stop

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Información del Vehículo y Espacio</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <strong><i class="fas fa-car mr-1"></i> Vehículo</strong>
                <p class="text-muted">{{ $ingreso->vehiculo->placa }} ({{ $ingreso->vehiculo->marca }} {{ $ingreso->vehiculo->modelo }})</p>
            </div>
            <div class="col-md-4">
                <strong><i class="fas fa-parking mr-1"></i> Espacio</strong>
                <p class="text-muted">Espacio #{{ $ingreso->espacio->numero }}</p>
            </div>
            <div class="col-md-4">
                <strong><i class="fas fa-calendar-alt mr-1"></i> Fecha y Hora de Ingreso</strong>
                <p class="text-muted">{{ $ingreso->fecha_ingreso }} {{ $ingreso->hora_ingreso }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <strong><i class="fas fa-id-card mr-1"></i> Cliente</strong>
                <p class="text-muted">{{ $ingreso->vehiculo->cliente->nombres ?? 'S/N' }}</p>
            </div>
            <div class="col-md-4">
                <strong><i class="fas fa-star mr-1"></i> Membresía</strong>
                <p class="text-muted">
                    @if($ingreso->tiene_membresia)
                        <span class="badge badge-success">Con Membresía</span>
                    @else
                        <span class="badge badge-secondary">Sin Membresía</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.ingreso_vehiculos.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>
</div>
@stop
