<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        @media print {
            @page {
                size: 80mm 200mm; /* Forzamos el tamaño de la ticketera */
                margin: 0;
            }
        }
        body {
            font-family: "Courier New", Courier, monospace;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 10px;
            width: 100%;
        }
        .text-center {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 5px 0;
            width: 100%;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .info-section {
            margin-top: 10px;
            text-align: left; /* Mantiene los datos a la izquierda pero dentro del contenedor centrado */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center bold">
            {{ $ajuste->nombre }} <br>
            {{ $ajuste->descripcion }} <br>
            Sucursal: {{ $ajuste->sucursal }} <br>
            {{ $ajuste->direccion }} <br>
            {{ $ajuste->telefono }}
        </div>

        <div class="divider"></div>
        <div class="text-center bold">
            TICKET: {{ $ticket->codigo_ticket }}
        </div>
        <div class="divider"></div>

        <div class="info-section">
            <span class="bold">Datos del cliente:</span> <br>
            <span class="bold">Señor(a):</span> {{ $ticket->cliente->nombres }} {{ $ticket->cliente->apellidos }} <br>
            <span class="bold">Documento:</span> {{ $ticket->cliente->numero_documento }} <br>
            <span class="bold">Placa del vehículo:</span> {{ $ticket->vehiculo->placa }} <br>
            
            <div class="divider"></div>
            
            <span class="bold">Espacio nro:</span> {{ $ticket->espacio->numero }} <br>
            <span class="bold">Fecha de ingreso:</span> {{ $ticket->fecha_ingreso }} <br>
            <span class="bold">Hora de ingreso:</span> {{ $ticket->hora_ingreso }}
        </div>

        <div class="divider"></div>

        <div class="text-center" style="font-size: 10px;">
            <span class="bold">Hora de impresión:</span> {{ $fecha_hora }} <br>
            <span class="bold">Usuario:</span> {{ $ticket->usuario->name ?? Auth::user()->name }}
        </div>
    </div>
</body>
</html>