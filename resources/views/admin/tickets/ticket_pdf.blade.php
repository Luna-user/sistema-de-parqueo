<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            line-height: 1.2;
            width: 300px;
            max-width: 300px;
            overflow-x: hidden;
            margin: 0px;
            padding: 0px;
            background-color: #ffffffff;
        }
        .container {
            border: 0px solid #000;
            margin: 0px;
            padding: 0px;
        }
        .header, .footer {
        }
        .line {
            border-top: 1px dashed #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <!--encabezado-->
        <div class="header" style="text-align: center">
            <b>{{ $ajuste->nombre }}</b><br>
            <b>{{ $ajuste->descripcion }}</b><br>
            <b>Sucursal: {{ $ajuste->sucursal }}</b><br>
            <b>{{ $ajuste->direccion }}</b><br>
            <b>{{ $ajuste->telefono }}</b><br>
        </div>
        
        <div class="line"></div>
        <!--Titulo-->
        <h3 style="margin: 5px 0; font-size: 14px; text-align: center;">TICKET: {{ $ticket->codigo_ticket }}</h3>
        <div class="line"></div>

        <!--Datos del cliente-->
        <div style="text-align: left;">
            <strong>Datos del cliente:</strong><br>
            <b>Señor(a):</b> {{ $ticket->cliente->nombres }} {{ $ticket->cliente->apellidos }}<br>
            <b>Documento:</b> {{ $ticket->cliente->numero_documento }}<br>
            <b>Placa del vehiculo:</b> {{ $ticket->vehiculo->placa }}<br>
        </div>
        <div class="line"></div>
        <!--Datos del pago-->
        <div>
            <b>Espacio nro: </b>{{$ticket->espacio->numero}}<br>
            <b>Fecha de ingreso: </b>{{$ticket->fecha_ingreso}}<br>
            <b>Hora de ingreso: </b>{{$ticket->hora_ingreso}}<br>
        </div>
        <div class="line"></div>
        <!--firmas-->
        <div class="footer" style="text-align: center">
            <small style="font-size: 6pt">
                <b>Hora de impresion: </b> {{$fecha_hora}} <br>
                <b>Usuario: </b> {{$ticket->usuario->name}}
            </small>
        </div>
    </div>
</body>
</html>