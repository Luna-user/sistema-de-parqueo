@extends('adminlte::page')
@section('title', 'Detalle de Pago')
@section('content_header')
<h1>Detalle del Pago #{{ $pago->id_pago }}</h1>
@stop
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-success">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fas fa-receipt mr-1"></i>Comprobante de Pago</h3>
                <span class="badge badge-success badge-lg" style="font-size:1.1rem;">
                    ${{ number_format($pago->monto, 2) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr><th>Fecha:</th><td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td></tr>
                            <tr><th>Método:</th><td>{{ $pago->metodoPago->nombre ?? '—' }}</td></tr>
                            <tr><th>Monto:</th><td><strong class="text-success h5">${{ number_format($pago->monto, 2) }}</strong></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        @if($pago->ingreso)
                        <div class="callout callout-info">
                            <h6>Pago por Hora</h6>
                            <p class="mb-0">Placa: <strong>{{ $pago->ingreso->vehiculo->placa ?? '—' }}</strong></p>
                            <p class="mb-0">Cliente: {{ $pago->ingreso->vehiculo->cliente->nombres ?? '—' }}</p>
                            <p class="mb-0">Espacio: #{{ $pago->ingreso->espacio->numero ?? '—' }}</p>
                            <p class="mb-0">Ingreso: {{ $pago->ingreso->fecha_ingreso }} {{ $pago->ingreso->hora_ingreso }}</p>
                        </div>
                        @elseif($pago->membresia)
                        <div class="callout callout-warning">
                            <h6>Pago de Membresía</h6>
                            <p class="mb-0">Placa: <strong>{{ $pago->membresia->vehiculo->placa ?? '—' }}</strong></p>
                            <p class="mb-0">Cliente: {{ $pago->membresia->vehiculo->cliente->nombres ?? '—' }}</p>
                            <p class="mb-0">Tipo: {{ $pago->membresia->tipoMembresia->nombre ?? '—' }}</p>
                            <p class="mb-0">Vigencia: {{ $pago->membresia->fecha_inicio }} → {{ $pago->membresia->fecha_fin }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.pagos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                <button onclick="window.print()" class="btn btn-primary float-right"><i class="fas fa-print"></i> Imprimir</button>
            </div>
        </div>
    </div>
</div>
@stop
