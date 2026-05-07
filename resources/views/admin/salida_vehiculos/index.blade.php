@extends('adminlte::page')
@section('title', 'Salidas de Vehículos')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-sign-out-alt text-danger mr-2"></i>Salidas de Vehículos</h1></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Salidas</li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title"><b>Salidas Registradas</b></h3>
                <div class="card-tools">
                    @can('crear salidas')
                    <a href="{{ route('admin.salida_vehiculos.create') }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-plus"></i> Nueva Salida
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="tablaSalidas" class="table table-striped table-hover table-sm">
                    <thead class="thead-light">
                        <tr><th>#</th><th>Placa</th><th>Cliente</th><th>Espacio</th><th>Ingreso</th><th>Salida</th><th>Pago</th></tr>
                    </thead>
                    <tbody>
                        @foreach($salidas as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge badge-dark">{{ $s->ingreso->vehiculo->placa ?? '—' }}</span></td>
                            <td>{{ $s->ingreso->vehiculo->cliente->nombres ?? '—' }}</td>
                            <td><span class="badge badge-primary">#{{ $s->ingreso->espacio->numero ?? '—' }}</span></td>
                            <td>{{ optional($s->ingreso)->fecha_ingreso }} {{ optional($s->ingreso)->hora_ingreso }}</td>
                            <td>{{ $s->fecha_salida }} {{ $s->hora_salida }}</td>
                            <td>
                                @php $pago = $s->ingreso->pagos->first(); @endphp
                                @if($pago)
                                    <span class="badge badge-success">${{ number_format($pago->monto,2) }}</span>
                                @else
                                    <span class="badge badge-secondary">—</span>
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
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $('#tablaSalidas').DataTable({ language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' }, order:[[0,'desc']], responsive: true });
    @if(session('mensaje'))
    Swal.fire({ icon: '{{ session("icono") }}', title: '{{ session("mensaje") }}', timer: 4000, showConfirmButton: false });
    @endif
});
</script>
@stop
