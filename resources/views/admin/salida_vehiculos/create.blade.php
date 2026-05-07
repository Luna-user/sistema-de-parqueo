@extends('adminlte::page')
@section('title', 'Registrar Salida')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0"><i class="fas fa-sign-out-alt text-danger mr-2"></i>Registrar Salida</h1></div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.salida_vehiculos.index') }}">Salidas</a></li>
                <li class="breadcrumb-item active">Nueva</li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-danger">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-parking mr-1"></i>Salida y Cobro</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.salida_vehiculos.store') }}" method="POST" id="formSalida">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Vehículo en Parqueo <span class="text-danger">*</span></label>
                            <select name="ingreso_id" id="ingreso_id" class="form-control select2 @error('ingreso_id') is-invalid @enderror"
                                required onchange="calcularMonto()">
                                <option value="">-- Seleccionar vehículo activo --</option>
                                @foreach($ingresos as $i)
                                <option value="{{ $i->id_ingreso }}"
                                    data-fecha="{{ $i->fecha_ingreso }}"
                                    data-hora="{{ $i->hora_ingreso }}"
                                    data-monto-base="{{ $ajuste ? $ajuste->monto : 5 }}"
                                    data-membresia="{{ $i->tiene_membresia ? 1 : 0 }}">
                                    {{ $i->vehiculo->placa ?? '—' }} — {{ $i->vehiculo->cliente->nombres ?? '—' }}
                                    (Ingresó: {{ \Carbon\Carbon::parse($i->fecha_ingreso)->format('d/m/Y') }} {{ $i->hora_ingreso }})
                                </option>
                                @endforeach
                            </select>
                            @error('ingreso_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Resumen del tiempo --}}
                        <div class="col-md-12" id="resumenTiempo" style="display:none;">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-clock"></i> Tiempo en parqueo</h5>
                                <div class="row">
                                    <div class="col-4 text-center"><small>Ingreso</small><p class="font-weight-bold" id="infoIngreso">—</p></div>
                                    <div class="col-4 text-center"><small>Ahora</small><p class="font-weight-bold" id="infoAhora">—</p></div>
                                    <div class="col-4 text-center"><small>Duración</small><p class="font-weight-bold text-danger" id="infoDuracion">—</p></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Método de Pago <span class="text-danger">*</span></label>
                            <select name="metodo_id" class="form-control @error('metodo_id') is-invalid @enderror" required>
                                <option value="">-- Seleccionar --</option>
                                @foreach($metodos as $m)
                                <option value="{{ $m->id_metodo }}">{{ $m->nombre }}</option>
                                @endforeach
                            </select>
                            @error('metodo_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Monto a Cobrar <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                <input type="number" step="0.01" min="0" name="monto" id="montoInput"
                                    class="form-control form-control-lg font-weight-bold @error('monto') is-invalid @enderror"
                                    value="{{ old('monto', 0) }}" required>
                                @error('monto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('admin.salida_vehiculos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        <button type="button" class="btn btn-danger btn-lg" onclick="confirmarSalida()">
                            <i class="fas fa-sign-out-alt"></i> Registrar Salida y Cobrar
                        </button>
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
function calcularMonto() {
    const sel = document.getElementById('ingreso_id');
    const opt = sel.options[sel.selectedIndex];
    if (!opt.value) { document.getElementById('resumenTiempo').style.display = 'none'; return; }

    const fechaIngreso = opt.dataset.fecha + ' ' + opt.dataset.hora;
    const montoBase    = parseFloat(opt.dataset.monto_base || opt.dataset.montoBase || 5);
    const tieneMemb    = opt.dataset.membresia == '1';

    const ingreso = new Date(fechaIngreso.replace(' ', 'T'));
    const ahora   = new Date();
    const diffMs  = ahora - ingreso;
    const horas   = Math.ceil(diffMs / (1000 * 60 * 60));

    document.getElementById('infoIngreso').textContent = fechaIngreso;
    document.getElementById('infoAhora').textContent   = ahora.toLocaleString('es-BO');
    document.getElementById('infoDuracion').textContent = horas + ' hora(s)';

    const monto = tieneMemb ? 0 : (horas * montoBase);
    document.getElementById('montoInput').value = monto.toFixed(2);
    document.getElementById('resumenTiempo').style.display = 'block';
}

function confirmarSalida() {
    const monto = document.getElementById('montoInput').value;
    Swal.fire({
        title: '¿Confirmar salida?',
        html: `Se registrará la salida y se cobrará <b>$${monto}</b>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-check"></i> Sí, registrar',
        cancelButtonText: 'Cancelar'
    }).then(r => { if (r.isConfirmed) document.getElementById('formSalida').submit(); });
}

@if(session('mensaje'))
Swal.fire({ icon: '{{ session("icono") }}', title: '{{ session("mensaje") }}', timer: 3000, showConfirmButton: false });
@endif
</script>
@stop
