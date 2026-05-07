@extends('adminlte::page')
@section('title', 'Bitácora del Sistema')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-history text-secondary mr-2"></i>Bitácora del Sistema</h1></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Bitácora</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><b>Registro de Actividad</b></h3>
                <div class="card-tools">
                    @can('limpiar bitacora')
                    <form action="{{ route('admin.bitacoras.destroyAll') }}" method="POST" id="formLimpiar" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarLimpiar()">
                            <i class="fas fa-broom"></i> Limpiar Todo
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablaBitacora" class="table table-striped table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th><th>Fecha</th><th>Hora</th>
                                <th>Acción</th><th>Tabla</th><th>Descripción</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bitacoras as $b)
                            <tr>
                                <td>{{ $b->id_bitacora }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $b->hora }}</td>
                                <td>
                                    @php
                                        $colores = ['CREATE'=>'success','INSERT'=>'success','UPDATE'=>'warning','DELETE'=>'danger','SELECT'=>'info','LOGIN'=>'primary'];
                                        $accionUp = strtoupper($b->accion);
                                        $color = collect($colores)->first(fn($c,$k) => str_contains($accionUp,$k), 'secondary');
                                    @endphp
                                    <span class="badge badge-{{ $color }}">{{ $b->accion }}</span>
                                </td>
                                <td><code>{{ $b->tabla_afectada }}</code></td>
                                <td>{{ \Str::limit($b->descripcion, 60) }}</td>
                                <td class="d-flex justify-content-center">
                                    @can('ver bitacora')
                                    <a href="{{ route('admin.bitacoras.show', $b->id_bitacora) }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $bitacoras->links() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    $('#tablaBitacora').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
        order: [[0, 'desc']], responsive: true, paging: false
    });
    @if(session('mensaje'))
    Swal.fire({ icon: '{{ session("icono") }}', title: '{{ session("mensaje") }}', timer: 3000, showConfirmButton: false });
    @endif
});
function confirmarLimpiar() {
    Swal.fire({
        title: '¿Limpiar toda la bitácora?',
        text: 'Esta acción eliminará TODOS los registros y no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-broom"></i> Sí, limpiar todo',
        cancelButtonText: 'Cancelar'
    }).then(r => { if (r.isConfirmed) document.getElementById('formLimpiar').submit(); });
}
</script>
@stop
