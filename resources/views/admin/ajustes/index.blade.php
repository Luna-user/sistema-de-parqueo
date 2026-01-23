@extends('adminlte::page')

@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ajustes del Sistema</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Ajustes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Llene los Campos del Formulario</h3>
                <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_sistema">Nombre del Sistema</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-building"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="nombre" id="nombre"
                                                value="{{ old('nombre',$ajuste->nombre ?? '') }}" placeholder="Ej: Sistema de Parqueo" required>
                                        </div>
                                        @error('nombre')
                                            <small style ="color: red;">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nombre_sistema">Descripcion</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-align-left"></i>
                                                </span>
                                            </div>
                                            <textarea class="form-control" name="descripcion" id="descripcion" rows="1"
                                                placeholder="Ej: Descripcion del Negocio" required>{{ old('descripcion',$ajuste->descripcion ?? '') }}</textarea>
                                        </div>
                                        @error('descripcion')
                                            <small style ="color: red;">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sucursal">Sucursal</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="sucursal" id="sucursal"
                                                value="{{ old('sucursal',$ajuste->sucursal ?? '') }}" placeholder="Ej: Sucursal Principal" required>
                                        </div>
                                        @error('sucursal')
                                            <small style ="color: red;">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Telefono</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="telefono" id="telefono"
                                                value="{{ old('telefono',$ajuste->telefono ?? '') }}" placeholder="Ej: +591 70707070" required>
                                        </div>
                                        @error('telefono')
                                            <small style ="color: red;">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="direccion">Direccion</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-home"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="direccion" id="direccion" rows="1"
                                                placeholder="Ej: Av. Siempre Viva 123" value="{{ old('direccion',$ajuste->direccion ?? '') }}" required>
                                        </div>
                                        @error('direccion')
                                            <small style ="color: red;">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="divisa">Moneda</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                            </div>
                                            <select class="form-control" name="divisa" id="divisa" required>
                                                <option value="">-- Seleccione tipo de Moneda --</option>
                                                
                                                <option value="Bs" {{ old('divisa',$ajuste->divisa ?? '') == 'Bs' ? 'selected' : '' }}>Bolivianos (Bs)</option>
                                                <option value="$" {{ old('divisa',$ajuste->divisa ?? '') == '$' ? 'selected' : '' }}>Dolares ($)</option>
                                            </select>
                                        </div>
                                        @error('divisa')
                                            <small style ="color: red;">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="correo_electronico">Correo Electronico</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control" name="correo_electronico" id="correo_electronico"
                                                value="{{ old('correo_electronico',$ajuste->correo_electronico ?? '') }}" placeholder="Ej: correo@ejemplo.com" required>
                                        </div>
                                        @error('correo_electronico')
                                            <small style ="color: red;">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pagina_web">Pagina Web</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-globe"></i>
                                                </span>
                                            </div>
                                            <input type="url" class="form-control" name="pagina_web" id="pagina_web"
                                                value="{{ old('pagina_web',$ajuste->pagina_web ?? '') }}" placeholder="Ej: https://www.TuEmpresa.com">
                                        </div>
                                        @error('pagina_web')
                                            <small style ="color: red;">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>            
                            </div>
                        </div>
                        <div class="col-md-4">                  
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo">Logo Principal</label>
                                        @if(!isset($ajuste) || !$ajuste->logo)
                                        <b> (*)</b>
                                        @endif
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-image"></i>
                                                </span>
                                            </div>
                                            <input type="file" class="form-control" name="logo" id="logo" 
                                            accept="image/*" onchange="mostrarImagen(event)" @if(!isset($ajuste) || !$ajuste->logo) required @endif>
                                        </div>
                                        <center>
                                            @if(isset($ajuste) && $ajuste->logo)
                                                <img id="preview1" src="{{asset('storage/logos/'.$ajuste->logo ?? '')}}" 
                                                style="max-width: 200px; margin-top: 10px;"/>
                                            @else
                                                <img id="preview1" src="" 
                                                style="max-width: 200px; margin-top: 10px;"/>
                                            @endif
                                            
                                        </center>
                                        @error('logo')
                                            <small style ="color: red;">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <script>
                                    const mostrarImagen = e => 
                                        document.getElementById('preview1').src = URL.createObjectURL(e.target.files[0]);
                                </script>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo_auto">Logo del Auto</label>
                                        @if(!isset($ajuste) || !$ajuste->logo_auto)
                                        <b> (*)</b>
                                        @endif
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-car"></i>
                                                </span>
                                            </div>
                                            <input type="file" class="form-control" name="logo_auto" id="logo_auto"
                                            accept="image/*" onchange="mostrarImagen2(event)" @if(!isset($ajuste) || !$ajuste->logo_auto) required @endif>
                                        </div>
                                        <center>
                                            @if(isset($ajuste) && $ajuste->logo_auto)
                                                <img id="preview2" src="{{asset('storage/logos/'.$ajuste->logo_auto ?? '')}}" 
                                                style="max-width: 200px; margin-top: 10px;"/>
                                            @else
                                                <img id="preview2" src="" 
                                                style="max-width: 200px; margin-top: 10px;"/>
                                            @endif
                                        </center>
                                        @error('logo_auto')
                                            <small style ="color: red;">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <script>
                                    const mostrarImagen2 = e => 
                                        document.getElementById('preview2').src = URL.createObjectURL(e.target.files[0]);
                                </script>
                            </div>
                        </div>
                    </div>
                        <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-danger"><b>(*)</b> Campos Obligatorios</p>
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fas fa-save"></i> Guardar
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