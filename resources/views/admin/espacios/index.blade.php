@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Listado de Espacios</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Listado de Espacios</li>
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
                <h3 class="card-title"><b> Espacios Registrados</b></h3>
                <div class="card-tools">
                    <a href="{{ url('/admin/espacios/create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Crear Nuevo Espacio
                    </a>
                </div>
            </div>
            {{-- Body --}}
            <div class="card-body">
                <div class="row">
                    @foreach ($espacios as $espacio)
                        <div class="col" style="text-align: center;">
                            <h2>{{ $espacio->numero }}</h2>
                            <button
                            @if ($espacio->estado == "disponible") class="btn btn-success" @endif
                            @if ($espacio->estado == "mantenimiento") class="btn btn-warning" @endif
                            @if ($espacio->estado == "ocupado") class="btn btn-danger" @endif
                            data-toggle="modal" data-target="#modal_cambiar_estado{{ $espacio->id }}">
                                <img src="{{asset('storage/logos/'.$ajuste->logo_auto ?? '')}}" 
                                    style="max-width: 100px; margin-top: 10px;">
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal_cambiar_estado{{ $espacio->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #3cbc47ff; color: white;">
                                            <h5 class="modal-title" id="exampleModalLabel">Cambiar el Estado del Espacio {{ $espacio->numero }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/admin/espacio/'. $espacio->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="estado">Estado</label><b> (*)</b>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-check-circle"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control" name="estado" id="estado" required>
                                                                <option value="">Seleccione un estado</option>
                                                                <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                                                <option value="ocupado" {{ old('estado') == 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                                                                <option value="mantenimiento" {{ old('estado') == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                                            </select>
                                                        </div>
                                                        @error('estado')
                                                                <small style ="color: red;">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class ="row">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-success">Guardar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5><b>{{ $espacio->estado }}</b></h5>
                        </div>    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
