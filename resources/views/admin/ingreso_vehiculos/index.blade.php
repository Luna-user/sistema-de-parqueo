@extends('adminlte::page')
@section('title', 'Ingresos de Vehículos')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-sign-in-alt text-success mr-2"></i>Ingresos de Vehículos</h1></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Ingresos</li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><b>Ingresos Registrados</b></h3>
                <div class="card-tools">
                    @can('crear ingresos')
                    <a href="{{ route('admin.ingreso_vehiculos.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Nuevo Ingreso
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablaIngresos" class="table table-striped table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th><th>Placa</th><th>Cliente</th><th>Espacio</th>
                                <th>Fecha/Hora Ingreso</th><th>Membresía</th><th>Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ingresos as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge badge-dark">{{ $i->vehiculo->placa ?? '—' }}</span></td>
                                <td>{{ $i->vehiculo->cliente->nombres ?? '—' }}</td>
                                <td><span class="badge badge-primary">#{{ $i->espacio->numero ?? '—' }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($i->fecha_ingreso)->format('d/m/Y') }} {{ $i->hora_ingreso }}</td>
                                <td>
                                    @if($i->tiene_membresia)
                                        <span class="badge badge-success"><i class="fas fa-check"></i> Sí</span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($i->salida)
                                        <span class="badge badge-info">{{ \Carbon\Carbon::parse($i->salida->fecha_salida)->format('d/m/Y') }}</span>
                                    @else
                                        <span class="badge badge-warning"><i class="fas fa-clock"></i> En parqueo</span>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $('#tablaIngresos').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
        order: [[0,'desc']], responsive: true
    });
    @if(session('mensaje'))
    Swal.fire({ icon: '{{ session("icono") }}', title: '{{ session("mensaje") }}', timer: 3000, showConfirmButton: false });
    @endif
});
</script>
@stop
