@extends('adminlte::page')
@section('title', 'Detalle Bitácora')
@section('content_header')
<h1>Detalle de Registro #{{ $bitacora->id_bitacora }}</h1>
@stop
@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card card-outline card-secondary">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-history mr-1"></i>Registro de Auditoría</h3></div>
            <div class="card-body">
                <table class="table table-sm table-bordered">
                    <tr><th width="35%">ID</th><td>{{ $bitacora->id_bitacora }}</td></tr>
                    <tr><th>Acción</th><td><span class="badge badge-primary">{{ $bitacora->accion }}</span></td></tr>
                    <tr><th>Tabla Afectada</th><td><code>{{ $bitacora->tabla_afectada }}</code></td></tr>
                    <tr><th>Fecha</th><td>{{ \Carbon\Carbon::parse($bitacora->fecha)->format('d/m/Y') }}</td></tr>
                    <tr><th>Hora</th><td>{{ $bitacora->hora }}</td></tr>
                    <tr><th>Descripción</th><td>{{ $bitacora->descripcion }}</td></tr>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.bitacoras.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
            </div>
        </div>
    </div>
</div>
@stop
