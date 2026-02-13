@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Modificar datos del Cliente</h1>
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
        <div class="card card-success">

            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Llene los Campos del Formulario</b></h3>
            </div>
            {{-- Body --}}
            <div class="card-body">
                <form action="{{ url('/admin/cliente/' . $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombres">Nombre Completo</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-check"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="nombres" id="nombres" 
                                        value="{{ old('nombres', $cliente->nombres) }}" placeholder="Nombre completo del cliente" required>
                                </div>
                                @error('nombres')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numero_documento">Numero de Documento</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="numero_documento" id="numero_documento" 
                                        value="{{ old('numero_documento', $cliente->numero_documento) }}" placeholder="Numero de documento" required>
                                </div>
                                @error('numero_documento')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="email" 
                                        value="{{ old('email', $cliente->email) }}" placeholder="Cliente@gmail.com" required>
                                </div>
                                @error('email')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono">Telefono</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="telefono" id="telefono" 
                                        value="{{ old('telefono', $cliente->telefono) }}" placeholder="Numero de telefono" required>
                                </div>
                                @error('telefono')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="genero">Género</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                    </div>
                                    <select class="form-control" name="genero" id="genero" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Masculino" {{ old('genero', $cliente->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Femenino" {{ old('genero', $cliente->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Otro" {{ old('genero', $cliente->genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>
                                @error('genero')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-circle-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Actualizar
                            </button>
                        </div>
                    </div>
                </form>       
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