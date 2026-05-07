@extends('adminlte::page')

@section('title', 'Tipos de Vehículos')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-car text-primary mr-2"></i>Tipos de Vehículos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Tipos de Vehículos</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><b>Tipos Registrados</b></h3>
                <div class="card-tools">
                    @can('crear tipo vehiculos')
                    <a href="{{ route('admin.tipo_vehiculos.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Nuevo Tipo
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablaTipos" class="table table-striped table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Vehículos</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipos as $tipo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge badge-info px-2 py-1">{{ $tipo->nombre }}</span></td>
                                <td>{{ $tipo->descripcion ?? '—' }}</td>
                                <td><span class="badge badge-secondary">{{ $tipo->vehiculos->count() }}</span></td>
                                <td class="text-center">
                                    @can('editar tipo vehiculos')
                                    <a href="{{ route('admin.tipo_vehiculos.edit', $tipo->id_tipo_vehiculo) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    @endcan
                                    @can('eliminar tipo vehiculos')
                                    <form action="{{ route('admin.tipo_vehiculos.destroy', $tipo->id_tipo_vehiculo) }}" method="POST" id="del-{{ $tipo->id_tipo_vehiculo }}" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar({{ $tipo->id_tipo_vehiculo }}, '{{ $tipo->nombre }}')">
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
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $('#tablaTipos').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
        responsive: true, autoWidth: false,
    });

    @if(session('mensaje'))
    Swal.fire({ icon: '{{ session("icono") }}', title: '{{ session("mensaje") }}', timer: 3000, showConfirmButton: false });
    @endif
});

function confirmarEliminar(id, nombre) {
    Swal.fire({
        title: '¿Eliminar tipo?',
        html: `¿Desea eliminar el tipo <b>${nombre}</b>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash"></i> Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then(result => { if (result.isConfirmed) document.getElementById('del-' + id).submit(); });
}
</script>
@stop
