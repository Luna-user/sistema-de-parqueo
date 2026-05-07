@extends('adminlte::page')
@section('title', 'Pagos')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-dollar-sign text-success mr-2"></i>Registro de Pagos</h1></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Pagos</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    {{-- Tarjetas resumen --}}
    <div class="col-md-4">
        <div class="info-box bg-gradient-success">
            <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Recaudado (hoy)</span>
                <span class="info-box-number">
                    ${{ number_format($pagos->where('fecha_pago', today()->toDateString())->sum('monto'), 2) }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box bg-gradient-primary">
            <span class="info-box-icon"><i class="fas fa-receipt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pagos Este Mes</span>
                <span class="info-box-number">{{ $pagos->where('fecha_pago', '>=', now()->startOfMonth()->toDateString())->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box bg-gradient-warning">
            <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total General</span>
                <span class="info-box-number">${{ number_format($pagos->sum('monto'), 2) }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><b>Pagos Registrados</b></h3>
                <div class="card-tools">
                    @can('crear pagos')
                    <a href="{{ route('admin.pagos.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Registrar Pago
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="tablaPagos" class="table table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th><th>Fecha</th><th>Cliente/Vehículo</th>
                            <th>Método</th><th>Tipo</th><th>Monto</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->fecha_pago)->format('d/m/Y') }}</td>
                            <td>
                                @if($p->ingreso)
                                    <span class="badge badge-dark">{{ $p->ingreso->vehiculo->placa ?? '—' }}</span>
                                    {{ $p->ingreso->vehiculo->cliente->nombres ?? '—' }}
                                @elseif($p->membresia)
                                    <span class="badge badge-purple">{{ $p->membresia->vehiculo->placa ?? '—' }}</span>
                                    {{ $p->membresia->vehiculo->cliente->nombres ?? '—' }}
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $p->metodoPago->nombre ?? '—' }}</td>
                            <td>
                                @if($p->membresia_id && !$p->ingreso_id)
                                    <span class="badge badge-warning">Membresía</span>
                                @elseif($p->ingreso_id)
                                    <span class="badge badge-info">Por hora</span>
                                @else
                                    <span class="badge badge-secondary">—</span>
                                @endif
                            </td>
                            <td><strong class="text-success">${{ number_format($p->monto, 2) }}</strong></td>
                            <td class="d-flex justify-content-center">
                                @can('ver pagos')
                                <a href="{{ route('admin.pagos.show', $p->id_pago) }}" class="btn btn-info btn-sm mr-1"><i class="fas fa-eye"></i> Ver</a>
                                @endcan

                                @can('eliminar pagos')
                                <form action="{{ route('admin.pagos.destroy', $p->id_pago) }}" method="POST" id="delP-{{ $p->id_pago }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar({{ $p->id_pago }})">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                                @endcan
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
    $('#tablaPagos').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
        order: [[0, 'desc']], responsive: true,
        buttons: [
            { text: '<i class="fas fa-file-excel"></i> Excel', extend: 'excel', className: 'btn btn-success btn-sm' },
            { text: '<i class="fas fa-file-pdf"></i> PDF',   extend: 'pdf',   className: 'btn btn-danger btn-sm'  },
            { text: '<i class="fas fa-print"></i> Imprimir', extend: 'print', className: 'btn btn-secondary btn-sm' },
        ]
    }).buttons().container().appendTo('#tablaPagos_wrapper .row:eq(0)');

    @if(session('mensaje'))
    Swal.fire({ icon: '{{ session("icono") }}', title: '{{ session("mensaje") }}', timer: 3000, showConfirmButton: false });
    @endif
});

function confirmarEliminar(id) {
    Swal.fire({
        title: '¿Eliminar pago?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then(r => { if (r.isConfirmed) document.getElementById('delP-' + id).submit(); });
}
</script>
@stop
