@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Seguimiento del Parqueo</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
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
            </div>
            {{-- Body --}}
            <div class="card-body">
                <div class="row">
                    @foreach ($espacios as $espacio)
                    @php
                        $ticket_activo = $tickets_activos->firstWhere('espacio_id',$espacio->id)
                    @endphp
                        <div class="col-md-1 col-4" style="text-align: center;">
                            <h5>ESP-{{ $espacio->numero }}</h5>

                            @if($ticket_activo)
                                <button class="btn btn-danger btn-ocupado" data-ticket-id="{{ $ticket_activo->id }}" style="width: 100%;height: 180px;">
                                    <img src="{{asset('storage/logos/'.$ajuste->logo_auto ?? '')}}" 
                                        style="max-width: 70px; margin-top: 15px;"><br>
                                        <small>{{ $ticket_activo->vehiculo->placa }}</small><br>
                                        <small>{{ $ticket_activo->fecha_ingreso }}</small><br>
                                        <small>{{ $ticket_activo->hora_ingreso }}</small>
                                </button>
                            @else
                                @if ($espacio->estado == "disponible")
                                    <button class="btn btn-success btn-ticket" data-espacio-id="{{ $espacio->id }}" data-numero-espacio="{{ $espacio->numero }}" style="width: 100%;height: 180px;">
                                        LIBRE
                                    </button>
                                @endif
                                @if ($espacio->estado == "mantenimiento")
                                    <button class="btn btn-warning btn-mantenimiento" style="width: 100%;height: 180px;">
                                        <small><b>Mantenimiento</b></small>
                                    </button>
                                @endif
                                @if ($espacio->estado == "ocupado")
                                    <button class="btn btn-danger" style="width: 100%;height: 180px;">
                                        OCUPADO
                                    </button>
                                @endif
                            @endif
                            
                            <br> <br>
                        </div>    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para el ticket -->
<div class="modal fade" id="modal_ticket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c00a2ff; color: white;">
                <h5 class="modal-title" id="exampleModalLabel">Generar Ticket del Espacio <span id="espacio"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/admin/tickets/create') }}" method="POST" id="form_ticket">
                @csrf
                    <input type="hidden" id="espacio_id" name="espacio_id">
                        <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="placa">Placa del Vehículo</label><b>*</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-car"></i></span>
                                </div>
                                <select name="vehiculo_id" id="vehiculo_id" class="form-control select2">
                                    <option value="">Buscar Vehiculo ...</option>
                                    @foreach ($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo->id }}">Placa: {{ $vehiculo->placa }} - Cliente: {{ $vehiculo->cliente->nombres }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('placa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div style="height: 33px;"></div>
                            <a href="{{ url('/admin/clientes/create') }}" class="btn btn-primary">Nuevo Cliente</a>
                        </div>
                    </div>
                </div>

                <div id="info_vehiculo">
                    
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="placa">Tarifas</label><b>*</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-car"></i></span>
                                </div>
                                <select name="tarifa_id" id="tarifa_id" class="form-control select2">
                                    @foreach ($tarifas as $tarifa)
                                        <option value="{{ $tarifa->id }}">Tarifa: {{ $tarifa->nombre }} - Tipo: {{ $tarifa->tipo }} - 
                                            Cantidad: {{ $tarifa->cantidad }} - Costo: {{ $ajuste->divisa ."". $tarifa->costo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('placa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="obs">Observacion</label>
                        <textarea name="obs" class="form-control" id="obs" cols="30" rows="2"></textarea>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <button class="btn btn-primary" type="submit">Registrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para mantenimiento -->
<div class="modal fade" id="modal_mantenimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #e2d700ff; color: white;">
                <h5 class="modal-title" id="exampleModalLabel">Estado del Parqueo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="text-align: center;">El estado de este espacio esta en mantenimiento</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ocupado -->
<div class="modal fade" id="modal_ocupado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #d00303ff; color: white;">
                <h5 class="modal-title" id="exampleModalLabel">Finalizar Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" id="btn_imprimir_ticket" class="btn btn-warning"><i class="fas fa-print"></i> Imprimir Ticket</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .select2-container .select2-selection--single{
        height: 40px !important;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() 
    {
        $('.select2').select2({
            allowClear: true,
            width: '90%',
            dropdownParent: $('#modal_ticket')
        });
        $('#vehiculo_id').on('change', function() {
            var vehiculo_id = $(this).val();
            if(vehiculo_id){
                $.ajax({
                    url: "{{ url('admin/tickets/vehiculo') }}/" + vehiculo_id,
                    type: 'GET',
                    success: function(data) {
                        $('#info_vehiculo').html(data);
                    },
                    error: function() {
                        $('#info_vehiculo').html('<p class="text-danger">Error al cargar la información del vehiculo</p>');
                    }
                });
            }else{
                alert('Debe seleccionar un vehiculo');
            }
        });
    });

    $('#form_ticket').on('submit', function() {
        var espacio_id =  $('#espacio_id').val();
        var vehiculo_id = $('#vehiculo_id').val();
        var tarifa_id = $('#tarifa_id').val();
        if(!espacio_id || !vehiculo_id || !tarifa_id){
           event.preventDefault();
           alert('Por favor, complete todos los campos');
        }
        
    });

    $('.btn-ticket').on('click', function() {
        var espacio_id = $(this).data('espacio-id');
        var numero_espacio = $(this).data('numero-espacio');
        $('#espacio_id').val(espacio_id);
        $('#espacio').html(numero_espacio);
        $('#modal_ticket').modal('show');
    });
    $('.btn-mantenimiento').on('click', function() {
        var espacio_id = $(this).data('espacio-id');
        $('#modal_mantenimiento').modal('show');
    });
    $('.btn-ocupado').on('click', function() {
        var ticket_id = $(this).data('ticket-id');
        var urlImprimir = "{{ url('admin/ticket/')}}"+"/"+ticket_id+"/imprimir";
        $('#btn_imprimir_ticket').attr('href', urlImprimir);
        $('#modal_ocupado').modal('show');
    });
</script>
@stop
