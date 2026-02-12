@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Modificar Tarifa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/tarifas') }}">Listado de Tarifas</a>
                </li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-success">

            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title"><b>Llene los Campos del Formulario</b></h3>
            </div>
            {{-- Body --}}
            <div class="card-body">
                <form action="{{ url('/admin/tarifa/' . $tarifa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre de la Tarifa</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                    </div>
                                    <select class="form-control" name="nombre" id="nombre">
                                        <option>Seleccione una tarifa</option>
                                        <option value="regular" {{ old('nombre', $tarifa->nombre) == 'regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="nocturna" {{ old('nombre', $tarifa->nombre) == 'nocturna' ? 'selected' : '' }}>Nocturna</option>
                                        <option value="fin_de_semana" {{ old('nombre', $tarifa->nombre) == 'fin_de_semana' ? 'selected' : '' }}>Fin de Semana</option>
                                        <option value="feriados" {{ old('nombre', $tarifa->nombre) == 'feriados' ? 'selected' : '' }}>Feriados</option>
                                    </select>
                                </div>
                                @error('nombre')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tipo de Tarifa</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </span>
                                    </div>
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="por_hora" {{ old('tipo', $tarifa->tipo) == 'por_hora' ? 'selected' : '' }}>Por Hora</option>
                                        <option value="por_dia" {{ old('tipo', $tarifa->tipo) == 'por_dia' ? 'selected' : '' }}>Por Día</option>
                                    </select>
                                </div>
                                @error('tipo')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Cantidad</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-sort-numeric-up"></i>
                                        </span>
                                    </div>
                                    <input class = "form-control" type="number" name="cantidad" id="cantidad"
                                        min="0" required value="{{ old('cantidad', $tarifa->cantidad) }}">
                                </div>
                                @error('cantidad')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Costo</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="number" name="costo" id="costo"
                                        step="0.01" min="0" required value="{{ old('costo', $tarifa->costo) }}">
                                </div>
                                @error('costo')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Minutos de Gracia</label><b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-hourglass-half"></i>
                                        </span>
                                    </div>
                                    <input class = "form-control" type="number" name="minutos_de_gracia" id="minutos_de_gracia"
                                        min="0" required value="{{ old('minutos_de_gracia', $tarifa->minutos_de_gracia) }}">
                                </div>
                                @error('minutos_de_gracia')
                                        <small style ="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('/admin/tarifas') }}" class="btn btn-secondary">
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