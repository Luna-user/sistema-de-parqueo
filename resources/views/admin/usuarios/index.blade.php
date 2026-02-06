@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Listado de Usuarios</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Usuarios Registrados</b></h3>
                <div class="card-tools">
                    <a href="{{ url('/admin/usuarios/create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Crear Nuevo Usuario
                    </a>
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table1" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10px">Nro</th>
                                <th>Rol del Usuario</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo Documento</th>
                                <th>Nro Documento</th>
                                <th>Telefono</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $usuario->roles->pluck('name')->implode(', ') }}</td>
                                <td>{{ $usuario->nombres }}</td>
                                <td>{{ $usuario->apellidos }}</td>
                                <td>{{ $usuario->tipo_documento }}</td>
                                <td>{{ $usuario->nro_documento }}</td>
                                <td>{{ $usuario->telefono }}</td>
                                <td style="text-align: center;">
                                    @if ($usuario->estado == 1)
                                        <span class="badge badge-success">Activo</span>
                                    @else
                                        <span class="badge badge-danger">Inactivo</span>
                                    @endif
                                </td>

                                <td class="d-flex justify-content-center">
                                    @if (!($usuario->deleted_at))
                                        <a href="{{ url('/admin/usuario/' . $usuario->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ url('/admin/usuario/' . $usuario->id . '/edit') }}" class="btn btn-success btn-sm mr-1">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ url('/admin/usuario/' . $usuario->id) }}" method="POST" id="miFormulario{{ $usuario->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="preguntar{{ $usuario->id }}(event)">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                        <script>
                                            function preguntar{{ $usuario->id }}(event) {
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: '¿Eliminar Usuario?',
                                                    text: "Desea eliminar el usuario: {{ $usuario->name }}",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Sí, eliminar',
                                                    cancelButtonText: 'Cancelar'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        document.getElementById('miFormulario{{ $usuario->id }}').submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    @else
                                        <form action="{{ url('/admin/usuario/' . $usuario->id . '/restaurar') }}" method="POST" id="miFormulario{{ $usuario->id }}">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="preguntar{{ $usuario->id }}(event)">
                                                <i class="fas fa-save"></i> Restaurar Usuario
                                            </button>
                                        </form>
                                        <script>
                                            function preguntar{{ $usuario->id }}(event) {
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: '¿Restaurar Usuario?',
                                                    text: "Desea restaurar el usuario: {{ $usuario->name }}",
                                                    icon: 'question',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#28a745',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Sí, restaurar',
                                                    cancelButtonText: 'Cancelar'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        document.getElementById('miFormulario{{ $usuario->id }}').submit();
                                                    }
                                                });
                                            }
                                        </script>
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

@section('css')
<style>
    #table1_wrapper .dt-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 15px;
    }
    #table1_wrapper .btn {
        color: #fff;
        border-radius: 4px;
        padding: 5px 15px;
        font-size: 14px;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {
        $("#table1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(filtrado de _MAX_ total Usuarios)",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [
                { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-secondary' },
                { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' },
                { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csvHtml5', className: 'btn btn-info' }, 
                { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger' },
                { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning' }
            ]
        }).buttons().container().appendTo('#table1_wrapper .row:eq(0)');
    });
</script>
@stop
