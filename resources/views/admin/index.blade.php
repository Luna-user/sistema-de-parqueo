@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h2><b>Bienvenido:</b> {{ Auth::user()->name }}</h2>
        <h5 class="text-primary font-weight-bold">Rol: {{ Auth::user()->roles->first()->name ?? 'N/A' }}</h5>
    </div>
@stop

@section('content')
<div class="row">
    {{-- LADO IZQUIERDO: Tarjetas y Gráficos (9 columnas) --}}
    <div class="col-lg-9">
        
        {{-- Tarjetas Blancas (Conteos) --}}
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center p-3">
                        <i class="fas fa-id-badge fa-2x text-info mr-3"></i>
                        <div>
                            <h6 class="mb-0 text-muted">Roles registrados</h6>
                            <h5 class="font-weight-bold mb-0">{{ $totalRoles }} roles</h5>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center p-3">
                        <i class="fas fa-users-cog fa-2x text-info mr-3"></i>
                        <div>
                            <h6 class="mb-0 text-muted">Usuarios registrados</h6>
                            <h5 class="font-weight-bold mb-0">{{ $totalUsuarios }} usuarios</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-12 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center p-3">
                        <i class="fas fa-parking fa-2x text-info mr-3"></i>
                        <div>
                            <h6 class="mb-0 text-muted">{{ $totalEspacios }} Espacios registrados</h6>
                            <small class="font-weight-bold text-dark">
                                {{ $espaciosLibres }} libres | {{ $espaciosOcupados }} ocupados
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center p-3">
                        <i class="fas fa-id-card fa-2x text-info mr-3"></i>
                        <div>
                            <h6 class="mb-0 text-muted">Membresías Activas</h6>
                            <h5 class="font-weight-bold mb-0 text-success">{{ $membresiasActivas }} vigentes</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center p-3">
                        <i class="fas fa-users fa-2x text-info mr-3"></i>
                        <div>
                            <h6 class="mb-0 text-muted">Clientes registrados</h6>
                            <h5 class="font-weight-bold mb-0">{{ $totalClientes }} clientes</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center p-3">
                        <i class="fas fa-car fa-2x text-info mr-3"></i>
                        <div>
                            <h6 class="mb-0 text-muted">Vehículos registrados</h6>
                            <h5 class="font-weight-bold mb-0">{{ $totalVehiculos }} vehículos</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center p-3">
                        <i class="fas fa-ticket-alt fa-2x text-info mr-3"></i>
                        <div>
                            <h6 class="mb-0 text-muted">Tickets activos</h6>
                            <h5 class="font-weight-bold mb-0 text-danger">{{ $ticketsActivos }} tickets</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tarjetas de Ingresos --}}
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-info shadow">
                    <div class="info-box-content">
                        <span class="info-box-number" style="font-size: 1.5rem;">$ {{ number_format($ingresosHoy, 2) }}</span>
                        <span class="info-box-text">Ingresos de hoy</span>
                    </div>
                    <span class="info-box-icon"><i class="fas fa-money-bill-wave" style="opacity: 0.3;"></i></span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-info shadow">
                    <div class="info-box-content">
                        <span class="info-box-number" style="font-size: 1.5rem;">$ {{ number_format($ingresosAyer, 2) }}</span>
                        <span class="info-box-text">Ingresos de ayer</span>
                    </div>
                    <span class="info-box-icon"><i class="fas fa-money-bill-wave" style="opacity: 0.3;"></i></span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-success shadow">
                    <div class="info-box-content">
                        <span class="info-box-number" style="font-size: 1.5rem;">$ {{ number_format($ingresosSemana, 2) }}</span>
                        <span class="info-box-text">Ingresos de esta semana</span>
                    </div>
                    <span class="info-box-icon"><i class="far fa-calendar-alt" style="opacity: 0.3;"></i></span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-success shadow">
                    <div class="info-box-content">
                        <span class="info-box-number" style="font-size: 1.5rem;">$ {{ number_format($ingresosSemanaAnterior, 2) }}</span>
                        <span class="info-box-text">Ingresos semana anterior</span>
                    </div>
                    <span class="info-box-icon"><i class="far fa-calendar-alt" style="opacity: 0.3;"></i></span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-warning shadow">
                    <div class="info-box-content text-white">
                        <span class="info-box-number" style="font-size: 1.5rem;">$ {{ number_format($ingresosMes, 2) }}</span>
                        <span class="info-box-text">Ingresos de este mes</span>
                    </div>
                    <span class="info-box-icon"><i class="fas fa-chart-line" style="opacity: 0.3; color: white;"></i></span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-warning shadow">
                    <div class="info-box-content text-white">
                        <span class="info-box-number" style="font-size: 1.5rem;">$ {{ number_format($ingresosMesAnterior, 2) }}</span>
                        <span class="info-box-text">Ingresos del mes anterior</span>
                    </div>
                    <span class="info-box-icon"><i class="fas fa-chart-bar" style="opacity: 0.3; color: white;"></i></span>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="info-box bg-danger shadow">
                    <div class="info-box-content">
                        <span class="info-box-number" style="font-size: 1.5rem;">$ {{ number_format($ingresosTotal, 2) }}</span>
                        <span class="info-box-text">Ingresos total en el sistema</span>
                    </div>
                    <span class="info-box-icon"><i class="fas fa-money-check-alt" style="opacity: 0.3;"></i></span>
                </div>
            </div>
        </div>

        {{-- Gráficos --}}
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom-0">
                        <h3 class="card-title font-weight-bold">Ingresos mensuales</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom-0">
                        <h3 class="card-title font-weight-bold">Estado de espacios</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Tabla de Membresías Vigentes --}}
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-0">
                <h3 class="card-title font-weight-bold">Membresías Vigentes (Estado)</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-sm">
                        <thead class="bg-light">
                            <tr>
                                <th>Cliente</th>
                                <th>Tipo Membresía</th>
                                <th>Fin de Membresía</th>
                                <th>Tiempo Restante</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($membresiasList as $membresia)
                                @php
                                    $diasRestantes = \Carbon\Carbon::today()->diffInDays($membresia->fecha_fin, false);
                                    $badgeColor = $diasRestantes > 7 ? 'success' : ($diasRestantes > 0 ? 'warning' : 'danger');
                                @endphp
                                <tr>
                                    <td>{{ $membresia->cliente->nombres }}</td>
                                    <td>{{ $membresia->tipo_membresia->nombre ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($membresia->fecha_fin)->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $badgeColor }}">
                                            {{ $diasRestantes > 0 ? $diasRestantes . ' días' : 'Vence hoy' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No hay membresías activas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- LADO DERECHO: Reloj y Calendario (3 columnas) --}}
    <div class="col-lg-3">
        <div class="text-center mb-4">
            <h1 id="clock" class="display-4 font-weight-bold mb-0 text-dark">00:00:00</h1>
            <h5 id="date" class="text-muted">Día, 0 de Mes de 0000</h5>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-0">
                <h3 class="card-title font-weight-bold">Calendario</h3>
            </div>
            <div class="card-body p-0">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
    <style>
        .info-box {
            border-radius: 8px;
            min-height: 100px;
        }
        .info-box-icon i {
            font-size: 3rem;
        }
        .fc-toolbar-title {
            font-size: 1.1rem !important;
            font-weight: bold;
        }
        .fc-header-toolbar {
            margin-bottom: 0.5em !important;
            padding: 10px;
        }
        .fc-view-harness {
            background-color: white;
        }
        .fc th {
            font-weight: 500;
            color: #6c757d;
            font-size: 0.85rem;
        }
        .fc-daygrid-day-number {
            font-size: 0.9rem;
            color: #343a40;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>

    <script>
        $(function () {
            // RELOJ EN TIEMPO REAL
            function updateTime() {
                const now = new Date();
                
                // Formatear Hora
                let hours = now.getHours();
                let minutes = now.getMinutes();
                let seconds = now.getSeconds();
                let ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; 
                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                const timeStr = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
                
                // Formatear Fecha
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                let dateStr = now.toLocaleDateString('es-ES', options);
                dateStr = dateStr.charAt(0).toUpperCase() + dateStr.slice(1);
                
                document.getElementById('clock').innerText = timeStr;
                document.getElementById('date').innerText = dateStr;
            }
            setInterval(updateTime, 1000);
            updateTime();

            // CALENDARIO STATIC (Visual)
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },
                height: 380,
                contentHeight: 350,
                fixedWeekCount: false,
                showNonCurrentDates: false
            });
            calendar.render();

            // GRÁFICO DE LÍNEAS (Ingresos Mensuales)
            var ingresosData = @json($ingresosPorMes);
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = {
                maintainAspectRatio : false,
                responsive : true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { grid: { display: true } }
                }
            }
            new Chart(lineChartCanvas, {
                type: 'line',
                data: {
                    labels  : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    datasets: [
                        {
                            label               : 'Ingresos ($)',
                            backgroundColor     : 'rgba(60,141,188,0.2)',
                            borderColor         : 'rgba(60,141,188,0.8)',
                            pointRadius         : 4,
                            pointColor          : '#3b8bba',
                            pointStrokeColor    : 'rgba(60,141,188,1)',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data                : ingresosData,
                            fill                : true,
                            tension             : 0.4
                        }
                    ]
                },
                options: lineChartOptions
            })

            // GRÁFICO DE PASTEL (Espacios)
            var espaciosLibres = {{ $espaciosLibres }};
            var espaciosOcupados = {{ $espaciosOcupados }};
            
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = {
                labels: ['Libres', 'Ocupados'],
                datasets: [
                    {
                        data: [espaciosLibres, espaciosOcupados],
                        backgroundColor : ['#28a745', '#dc3545'],
                    }
                ]
            }
            var pieOptions = {
                maintainAspectRatio : false,
                responsive : true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
        });
    </script>
@stop