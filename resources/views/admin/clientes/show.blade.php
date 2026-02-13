@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"><b>Cliente : {{ $cliente->nombres }}</b></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/clientes') }}">Listado de Clientes</a>
                </li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Datos Registrados del Cliente</b></h3>
            </div>
            {{-- Body --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="nombres"><i class="fas fa-user-check"></i>Nombre Completo</label>
                            <p>{{ $cliente->nombres }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="numero_documento"><i class="fas fa-id-card"></i>Numero de Documento</label>
                            <p>{{ $cliente->numero_documento }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i>Correo Electronico</label>
                            <p>{{ $cliente->email }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="telefono"><i class="fas fa-phone"></i>Telefono</label>
                            <p>{{ $cliente->telefono }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="genero"><i class="fas fa-venus-mars"></i>Género</label>
                            <p>{{ $cliente->genero }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="estado"><i class="fas fa-check-circle"></i>Estado</label><br>
                            @if($cliente->estado == 1)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">Inactivo</span>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-circle-left"></i> Regresar
                        </a>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">

            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Listado de Vehículos</b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalCreateVehiculo">
                        <i class="fas fa-plus"></i> Crear Nuevo Vehículo
                    </button>
                    <div class="modal fade" id="ModalCreateVehiculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #00123fff; color: white;">
                                    <h5 class="modal-title" id="exampleModalLabel">Registro de Vehículo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="placa">Placa del Vehículo</label><b>*</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-car"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="placa" id="placa"
                                                        value="{{ old('placa') }}" placeholder="GTA-6767" style="text-transform: uppercase;" required>
                                                    </div>
                                                    @error('placa')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="marca">Marca del Vehículo</label><b>*</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-industry"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="marca" id="marca"
                                                        value="{{ old('marca') }}" placeholder="Toyota" style="text-transform: uppercase;" required>
                                                    </div>
                                                    @error('marca')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="modelo">Modelo del Vehiculo</label><b>*</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-car-side"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="modelo" id="modelo"
                                                        value="{{ old('modelo') }}" placeholder="Corolla, Hilux, BMW, etc" style="text-transform: uppercase;" required>
                                                    </div>
                                                    @error('modelo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="color">Color del Vehiculo</label><b>*</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-palette"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="color" id="color"
                                                        value="{{ old('color') }}" placeholder="Blanco, Negro, Gris, etc" style="text-transform: uppercase;" required>
                                                    </div>
                                                    @error('color')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="tipo">Tipo del Vehiculo</label><b>*</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-truck"></i></span>
                                                        </div>
                                                        <select class="form-control" name="tipo" id="tipo" required>
                                                            <option value="Auto" {{ old('tipo') == 'Auto' ? 'selected' : '' }}>Auto</option>
                                                            <option value="Moto" {{ old('tipo') == 'Moto' ? 'selected' : '' }}>Moto</option>
                                                            <option value="Bicicleta" {{ old('tipo') == 'Bicicleta' ? 'selected' : '' }}>Bicicleta</option>
                                                            <option value="Camion" {{ old('tipo') == 'Camion' ? 'selected' : '' }}>Camion</option>
                                                        </select>
                                                    </div>
                                                    @error('tipo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Registrar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>               
                </div>    
            </div>
            {{-- Body --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table1" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Color</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cliente->vehiculos as $vehiculo)
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $vehiculo->placa }}</td>
                                <td>{{ $vehiculo->marca }}</td>
                                <td>{{ $vehiculo->modelo }}</td>
                                <td>{{ $vehiculo->color }}</td>
                                <td>{{ $vehiculo->tipo }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ url('/admin/cliente/vehiculo/' . $vehiculo->id . '/edit') }}" class="btn btn-success btn-sm mr-1">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ url('/admin/cliente/vehiculo/' . $vehiculo->id) }}" method="POST" id="miFormulario{{ $vehiculo->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="preguntar{{ $role->id }}(event)">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>

                                    {{-- Script dinámico para cada botón de borrar --}}
                                    <script>
                                        function preguntar{{ $vehiculo->id }}(event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: '¿Eliminar Vehículo?',
                                                text: "Desea eliminar el vehículo",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Sí, eliminar',
                                                cancelButtonText: 'Cancelar'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('miFormulario{{ $vehiculo->id }}').submit();
                                                }
                                            });
                                        }
                                    </script>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Vehículos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Vehículos",
                "infoFiltered": "(filtrado de _MAX_ total Vehículos)",
                "lengthMenu": "Mostrar _MENU_ Vehículos",
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