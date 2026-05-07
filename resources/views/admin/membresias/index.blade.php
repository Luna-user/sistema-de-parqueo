@extends('adminlte::page')
@section('title', 'Membresías')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-id-badge text-purple mr-2"></i>Membresías</h1></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Membresías</li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-purple">
            <div class="card-header">
                <h3 class="card-title"><b>Membresías Registradas</b></h3>
                <div class="card-tools">
                    @can('crear membresias')
                    <a href="{{ route('admin.membresias.create') }}" class="btn btn-purple btn-sm">
                        <i class="fas fa-plus"></i> Nueva Membresía
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="tablaMembresias" class="table table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th><th>Vehículo (Placa)</th><th>Cliente</th>
                            <th>Tipo</th><th>Inicio</th><th>Fin</th><th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($membresias as $m)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge badge-dark">{{ $m->vehiculo->placa ?? '—' }}</span></td>
                            <td>{{ $m->vehiculo->cliente->nombres ?? '—' }}</td>
                            <td>{{ $m->tipoMembresia->nombre ?? '—' }}</td>
                            <td>{{ \Carbon\Carbon::parse($m->fecha_inicio)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($m->fecha_fin)->format('d/m/Y') }}</td>
                            <td>
                                @if($m->estado === 'Activa')
                                    <span class="badge badge-success">Activa</span>
                                @elseif($m->estado === 'Vencida')
                                    <span class="badge badge-danger">Vencida</span>
                                @else
                                    <span class="badge badge-warning">Suspendida</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-center">
                                @can('ver membresias')
                                <a href="{{ route('admin.membresias.show', $m->id_membresia) }}" class="btn btn-info btn-sm mr-1"><i class="fas fa-eye"></i> Ver</a>
                                @endcan
                                
                                @can('editar membresias')
                                <a href="{{ route('admin.membresias.edit', $m->id_membresia) }}" class="btn btn-success btn-sm mr-1"><i class="fas fa-edit"></i> Editar</a>
                                @endcan

                                @can('eliminar membresias')
                                <form action="{{ route('admin.membresias.destroy', $m->id_membresia) }}" method="POST" id="delM-{{ $m->id_membresia }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar({{ $m->id_membresia }})">
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
    $('#tablaMembresias').DataTable({ language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' }, responsive: true });
    @if(session('mensaje'))
    Swal.fire({ icon: '{{ session("icono") }}', title: '{{ session("mensaje") }}', timer: 3000, showConfirmButton: false });
    @endif
});
function confirmarEliminar(id) {
    Swal.fire({ title: '¿Eliminar membresía?', icon: 'warning', showCancelButton: true,
        confirmButtonColor: '#e3342f', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar', cancelButtonText: 'Cancelar'
    }).then(r => { if (r.isConfirmed) document.getElementById('delM-' + id).submit(); });
}
</script>
@stop
