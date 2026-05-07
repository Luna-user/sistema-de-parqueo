@extends('adminlte::page')
@section('title', 'Tipos de Membresías')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-id-card text-warning mr-2"></i>Tipos de Membresías</h1></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Tipos de Membresías</li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title"><b>Tipos Registrados</b></h3>
                <div class="card-tools">
                    @can('crear tipo membresias')
                    <a href="{{ route('admin.tipo_membresias.create') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-plus"></i> Nuevo Tipo
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="tablaMembresias" class="table table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr><th>#</th><th>Nombre</th><th>Costo</th><th>Membresías activas</th><th class="text-center">Acciones</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($tipos as $tipo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tipo->nombre ?? '—' }}</td>
                            <td><strong>{{ number_format($tipo->costo, 2) }}</strong></td>
                            <td><span class="badge badge-secondary">{{ $tipo->membresias->count() }}</span></td>
                            <td class="text-center">
                                @can('editar tipo membresias')
                                <a href="{{ route('admin.tipo_membresias.edit', $tipo->id_tipo_membresia) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Editar</a>
                                @endcan
                                
                                @can('eliminar tipo membresias')
                                <form action="{{ route('admin.tipo_membresias.destroy', $tipo->id_tipo_membresia) }}" method="POST" id="delM-{{ $tipo->id_tipo_membresia }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar({{ $tipo->id_tipo_membresia }}, '{{ $tipo->nombre ?? 'este tipo' }}')">
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
function confirmarEliminar(id, nombre) {
    Swal.fire({ title: '¿Eliminar tipo?', html: `¿Desea eliminar <b>${nombre}</b>?`, icon: 'warning', showCancelButton: true,
        confirmButtonColor: '#e3342f', cancelButtonColor: '#6c757d', confirmButtonText: 'Sí, eliminar', cancelButtonText: 'Cancelar'
    }).then(r => { if (r.isConfirmed) document.getElementById('delM-' + id).submit(); });
}
</script>
@stop
