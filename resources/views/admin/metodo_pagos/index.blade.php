@extends('adminlte::page')
@section('title', 'Métodos de Pago')
@section('content_header')
<h1 class="m-0"><i class="fas fa-money-bill-wave text-success mr-2"></i>Métodos de Pago</h1>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><b>Métodos Registrados</b></h3>
                <div class="card-tools">
                    @can('crear metodos pago')
                    <a href="{{ route('admin.metodo_pagos.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Nuevo Método</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="tablaMetodos" class="table table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr><th>#</th><th>Nombre</th><th>Pagos asociados</th><th class="text-center">Acciones</th></tr>
                    </thead>
                    <tbody>
                        @foreach($metodos as $m)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge badge-success px-2 py-1">{{ $m->nombre }}</span></td>
                            <td><span class="badge badge-secondary">{{ $m->pagos->count() }}</span></td>
                            <td class="d-flex justify-content-center">
                                @can('editar metodos pago')
                                <a href="{{ route('admin.metodo_pagos.edit', $m->id_metodo) }}" class="btn btn-success btn-sm mr-1"><i class="fas fa-edit"></i> Editar</a>
                                @endcan

                                @can('eliminar metodos pago')
                                <form action="{{ route('admin.metodo_pagos.destroy', $m->id_metodo) }}" method="POST" id="delMP-{{ $m->id_metodo }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar({{ $m->id_metodo }}, '{{ $m->nombre }}')">
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
    $('#tablaMetodos').DataTable({ language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' }, responsive: true });
    @if(session('mensaje'))
    Swal.fire({ icon: '{{ session("icono") }}', title: '{{ session("mensaje") }}', timer: 3000, showConfirmButton: false });
    @endif
});
function confirmarEliminar(id, nombre) {
    Swal.fire({ title: '¿Eliminar método?', html: `¿Eliminar <b>${nombre}</b>?`, icon: 'warning', showCancelButton: true,
        confirmButtonColor: '#e3342f', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar', cancelButtonText: 'Cancelar'
    }).then(r => { if (r.isConfirmed) document.getElementById('delMP-' + id).submit(); });
}
</script>
@stop
