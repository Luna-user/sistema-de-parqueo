@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Información del Usuario</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/usuarios') }}">Listado de Usuarios</a>
                </li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-info">

            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b><i class="fas fa-user"></i> Información Personal</b></h3>
            </div>
            {{-- Body --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <b><i class="fas fa-user"></i> Nombre Completo</b>
                        <p>{{ $usuario->name}}</p>
                    </div>
                    <div class="col-md-3">
                        <b><i class="fas fa-envelope"></i> Correo Electronico</b>
                        <p>{{ $usuario->email}}</p>
                    </div>
                    <div class="col-md-3">
                        <b><i class="fas fa-id-card"></i> Documento</b>
                        <p>{{ $usuario->tipo_documento. " - " . $usuario->nro_documento}}</p>
                    </div>
                    <div class="col-md-3">
                        <b><i class="fas fa-mobile-alt"></i> Telefono</b>
                        <p>{{ $usuario->telefono}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <b><i class="fas fa-birthday-cake"></i> Fecha de Nacimiento</b>
                        <p>{{ $usuario->fecha_nacimiento}}</p>
                    </div>
                    <div class="col-md-3">
                        <b><i class="fas fa-venus-mars"></i> Genero</b>
                        <p>{{ $usuario->genero}}</p>
                    </div>
                    <div class="col-md-6">
                        <b><i class="fas fa-map-marker-alt"></i> Direccion</b>
                        <p>{{ $usuario->direccion}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-info">
            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b><i class="fas fa-phone"></i> Contactos de Emergencia</b></h3>
            </div>
            {{-- Body --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <b><i class="fas fa-user"></i> Nombre del Contacto</b>
                        <p>{{ $usuario->contacto_nombre}}</p>
                    </div>
                    <div class="col-md-4">
                        <b><i class="fas fa-mobile-alt"></i> Telefono</b>
                        <p>{{ $usuario->contacto_telefono}}</p>
                    </div>
                    <div class="col-md-4">
                        <b><i class="fas fa-heart"></i> Parentesco</b>
                        <p>{{ $usuario->contacto_parentesco}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"><b><i class="fas fa-user"></i> Perfil</b></h3>
            </div>
            <div class="card-body">
                <div class="row" style="text-align: center;">
                    <div class="col-md-12">
                        @if($usuario->foto)
                            <img src="{{ asset('storage/' . $usuario->foto) }}" class="profile-user-img img-fluid img-circle" alt="Foto del Usuario" >
                        @else
                            <img src="{{ url('/images/avatar.jpg') }}" class="profile-user-img img-fluid img-circle" alt="Foto del Usuario" >
                        @endif

                        <h3 class="profile-username text-center"><b>{{ $usuario->name }}</b></h3>
                        <p class="badge badge-info"><b>{{ $usuario->roles->pluck('name')->implode(', ') }}</b></p>
                        <br>
                        @if ($usuario->estado == 1)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-danger">Inactivo</span>
                        @endif

                        <hr>
                        <small>
                            <b><i class="fas fa-calendar-alt"></i> Fecha y Hora de Registro:</b> {{ $usuario->created_at->format('d/m/Y H:i:s') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-circle-left"></i> Cancelar
        </a>
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