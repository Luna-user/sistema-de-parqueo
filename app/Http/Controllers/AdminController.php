<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Espacio;
use App\Models\Pago;
use App\Models\IngresoVehiculo;
use App\Models\SalidaVehiculo;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\Membresia;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // ─── TARJETAS BLANCAS (Conteo) ──────────────────────────────────────
        $totalRoles = Role::count();
        $totalUsuarios = User::count();
        $totalEspacios = Espacio::count();
        $espaciosLibres = Espacio::where('estado', 'Disponible')->count();
        $espaciosOcupados = Espacio::where('estado', 'Ocupado')->count();
        $totalClientes = Cliente::count();
        $totalVehiculos = Vehiculo::count();
        $ticketsActivos = IngresoVehiculo::doesntHave('salida')->count();
        $membresiasActivas = Membresia::where('estado', 1)->where('fecha_fin', '>=', Carbon::today())->count();

        // ─── TARJETAS DE INGRESOS ───────────────────────────────────────────
        $ingresosHoy = Pago::whereDate('fecha_pago', Carbon::today())->sum('monto');
        $ingresosAyer = Pago::whereDate('fecha_pago', Carbon::yesterday())->sum('monto');
        $ingresosSemana = Pago::whereBetween('fecha_pago', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('monto');
        $ingresosSemanaAnterior = Pago::whereBetween('fecha_pago', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->sum('monto');
        $ingresosMes = Pago::whereMonth('fecha_pago', Carbon::now()->month)->whereYear('fecha_pago', Carbon::now()->year)->sum('monto');
        $ingresosMesAnterior = Pago::whereMonth('fecha_pago', Carbon::now()->subMonth()->month)->whereYear('fecha_pago', Carbon::now()->subMonth()->year)->sum('monto');
        $ingresosTotal = Pago::sum('monto');

        // ─── LISTADO DE MEMBRESÍAS ACTIVAS (TIEMPO RESTANTE) ────────────────
        $membresiasList = Membresia::with(['cliente', 'tipo_membresia'])
            ->where('estado', 1)
            ->where('fecha_fin', '>=', Carbon::today())
            ->orderBy('fecha_fin', 'asc')
            ->get();

        // ─── DATOS PARA EL GRÁFICO DE LÍNEAS (Ingresos Mensuales) ────────────
        $ingresosPorMes = [];
        for ($i = 1; $i <= 12; $i++) {
            $ingresosPorMes[] = Pago::whereMonth('fecha_pago', $i)->whereYear('fecha_pago', Carbon::now()->year)->sum('monto');
        }

        return view('admin.index', compact(
            'totalRoles', 'totalUsuarios', 'totalEspacios', 'espaciosLibres', 'espaciosOcupados',
            'totalClientes', 'totalVehiculos', 'ticketsActivos', 'membresiasActivas',
            'ingresosHoy', 'ingresosAyer', 'ingresosSemana', 'ingresosSemanaAnterior',
            'ingresosMes', 'ingresosMesAnterior', 'ingresosTotal',
            'membresiasList', 'ingresosPorMes'
        ));
    }
}
