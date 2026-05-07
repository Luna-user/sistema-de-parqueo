@extends('adminlte::page')
@section('title', 'Registrar Ingreso')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-sign-in-alt text-success mr-2"></i>Registrar Ingreso</h1></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.ingreso_vehiculos.index') }}">Ingresos</a></li>
                <li class="breadcrumb-item active">Nuevo</li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="row">
    {{-- Formulario de ingreso simplificado --}}
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-parking mr-1"></i>Datos del Ingreso</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.ingreso_vehiculos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Vehículo <span class="text-danger">*</span></label>
                            <select name="vehiculo_id" id="vehiculo_id" class="form-control select2 @error('vehiculo_id') is-invalid @enderror" required>
                                <option value="">-- Seleccionar vehículo --</option>
                                @foreach($vehiculos as $v)
                                <option value="{{ $v->id_vehiculo }}">{{ $v->placa }} — {{ $v->cliente->nombres ?? '?' }}</option>
                                @endforeach
                            </select>
                            @error('vehiculo_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Espacio Disponible <span class="text-danger">*</span></label>
                            <select name="espacio_id" class="form-control @error('espacio_id') is-invalid @enderror" required>
                                <option value="">-- Seleccionar espacio --</option>
                                @foreach($espacios as $e)
                                <option value="{{ $e->id_espacio }}"># {{ $e->numero }}</option>
                                @endforeach
                            </select>
                            @error('espacio_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>¿Tiene Membresía?</label>
                            <select name="tiene_membresia" id="tiene_membresia" class="form-control" onchange="toggleMembresia()">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group" id="grupoMembresia" style="display:none;">
                            <label>Membresía Activa / Vencida</label>
                            <select name="membresia_id" id="membresia_id" class="form-control" onchange="validarMembresia()">
                                <option value="">-- Seleccionar Membresía --</option>
                                @foreach($membresias as $m)
                                    @php
                                        $vencida = \Carbon\Carbon::parse($m->fecha_fin)->isPast();
                                    @endphp
                                <option value="{{ $m->id_membresia }}" data-vencida="{{ $vencida ? '1' : '0' }}">
                                    {{ $m->vehiculo->placa ?? '—' }} — {{ $m->vehiculo->cliente->nombres ?? '—' }} 
                                    ({{ $vencida ? 'VENCIDA' : 'Vence: ' . \Carbon\Carbon::parse($m->fecha_fin)->format('d/m/Y') }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('admin.ingreso_vehiculos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-sign-in-alt"></i> Registrar Ingreso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function toggleMembresia() {
    const val = document.getElementById('tiene_membresia').value;
    document.getElementById('grupoMembresia').style.display = val == '1' ? 'block' : 'none';
}

function validarMembresia() {
    const sel = document.getElementById('membresia_id');
    const opt = sel.options[sel.selectedIndex];
    if (opt.getAttribute('data-vencida') === '1') {
        Swal.fire({
            title: '¡MEMBRESÍA VENCIDA!',
            text: 'Esta membresía ha caducado. El cliente debe pagar la tarifa normal o renovar.',
            icon: 'warning',
            confirmButtonText: 'Entendido'
        });
    }
}
</script>
@stop
