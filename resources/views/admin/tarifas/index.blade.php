@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Listado de Tarifas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Tarifas</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Tarifas Registradas por Hora</b></h3>
                <div class="card-tools">
                    <a href="{{ url('/admin/tarifas/create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Crear Nueva Tarifa
                    </a>
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="table1" class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Tipo</th>
                                        <th>Costo</th>
                                        <th>Minutos de Gracia</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $conta = 1;
                                    @endphp
                                    @foreach ($tarifas as $tarifa)
                                        @if($tarifa->tipo == 'por_hora')
                                        <tr>
                                            <td style="text-align: center;">{{ $conta++ }}</td>
                                            <td>{{ $tarifa->nombre }}</td>
                                            <td style="text-align: center;">{{ $tarifa->cantidad }}</td>
                                            <td>{{ $tarifa->tipo }}</td>
                                            <td>{{$ajuste->divisa . " " . $tarifa->costo }}</td>
                                            <td style="text-align: center;">{{ $tarifa->minutos_de_gracia }} min</td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ url('/admin/tarifa/' . $tarifa->id . '/edit') }}" class="btn btn-success btn-sm mr-1">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <form action="{{ url('/admin/tarifa/' . $tarifa->id) }}" method="POST" id="miFormulario{{ $tarifa->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="preguntar{{ $tarifa->id }}(event)">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                </form>

                                                {{-- Script dinámico para cada botón de borrar --}}
                                                <script>
                                                    function preguntar{{ $tarifa->id }}(event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: '¿Eliminar Tarifa?',
                                                            text: "Desea eliminar la tarifa: {{ $tarifa->nombre }}",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Sí, eliminar',
                                                            cancelButtonText: 'Cancelar'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                document.getElementById('miFormulario{{ $tarifa->id }}').submit();
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-outline card-primary">
            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Tarifas Registradas por Dia</b></h3>
                <div class="card-tools">
                    <a href="{{ url('/admin/tarifas/create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Crear Nueva Tarifa
                    </a>
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="table2" class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Tipo</th>
                                        <th>Costo</th>
                                        <th>Minutos de Gracia</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $contador = 1;
                                    @endphp
                                    @foreach ($tarifas as $tarifa)
                                        @if($tarifa->tipo == 'por_dia')
                                        <tr>
                                            <td style="text-align: center;">{{ $contador++ }}</td>
                                            <td>{{ $tarifa->nombre }}</td>
                                            <td style="text-align: center;">{{ $tarifa->cantidad }}</td>
                                            <td>{{ $tarifa->tipo }}</td>
                                            <td>{{$ajuste->divisa . " " . $tarifa->costo }}</td>
                                            <td style="text-align: center;">{{ $tarifa->minutos_de_gracia }} min</td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ url('/admin/tarifa/' . $tarifa->id . '/edit') }}" class="btn btn-success btn-sm mr-1">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <form action="{{ url('/admin/tarifa/' . $tarifa->id) }}" method="POST" id="miFormulario{{ $tarifa->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="preguntar{{ $tarifa->id }}(event)">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                </form>

                                                {{-- Script dinámico para cada botón de borrar --}}
                                                <script>
                                                    function preguntar{{ $tarifa->id }}(event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: '¿Eliminar Tarifa?',
                                                            text: "Desea eliminar la tarifa: {{ $tarifa->nombre }}",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Sí, eliminar',
                                                            cancelButtonText: 'Cancelar'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                document.getElementById('miFormulario{{ $tarifa->id }}').submit();
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    #table1_wrapper .dt-buttons {
        background-color: transparent;
        box-shadow: none;
        border: none;
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

    #table2_wrapper .dt-buttons {
        background-color: transparent;
        box-shadow: none;
        border: none;
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 15px;
    }
    #table2_wrapper .btn {
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Tarifas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Tarifas",
                "infoFiltered": "(filtrado de _MAX_ total Tarifas)",
                "lengthMenu": "Mostrar _MENU_ Tarifas",
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

    $(function () {
        $("#table2").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Tarifas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Tarifas",
                "infoFiltered": "(filtrado de _MAX_ total Tarifas)",
                "lengthMenu": "Mostrar _MENU_ Tarifas",
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
        }).buttons().container().appendTo('#table2_wrapper .row:eq(0)');
    });
</script>
@stop
