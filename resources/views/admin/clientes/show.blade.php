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
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop