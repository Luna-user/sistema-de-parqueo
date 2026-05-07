<?php

namespace App\Http\Controllers;

use App\Models\SalidaVehiculo;
use App\Models\IngresoVehiculo;
use App\Models\Pago;
use App\Models\MetodoPago;
use App\Models\Ajuste;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalidaVehiculoController extends Controller
{
    public function index()
    {
        $salidas = SalidaVehiculo::with(['ingreso.vehiculo.cliente', 'ingreso.espacio'])
            ->latest()
            ->get();
        return view('admin.salida_vehiculos.index', compact('salidas'));
    }

    public function create()
    {
        // Solo ingresos que NO tienen salida aún
        $ingresos = IngresoVehiculo::doesntHave('salida')
            ->with(['vehiculo.cliente', 'espacio'])
            ->get();
        $metodos = MetodoPago::all();
        $ajuste  = Ajuste::first();

        return view('admin.salida_vehiculos.create', compact('ingresos', 'metodos', 'ajuste'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ingreso_id'  => 'required|exists:ingreso_vehiculos,id_ingreso',
            'metodo_id'   => 'required|exists:metodo_pagos,id_metodo',
            'monto'       => 'required|numeric|min:0',
        ]);

        $ingreso = IngresoVehiculo::with('espacio')->findOrFail($request->ingreso_id);

        // Verificar que no tenga salida ya registrada
        if ($ingreso->salida) {
            return redirect()->back()
                ->with('mensaje', 'Este vehículo ya tiene salida registrada.')
                ->with('icono', 'error');
        }

        $now = Carbon::now();

        // Registrar salida
        $salida = SalidaVehiculo::create([
            'ingreso_id'  => $request->ingreso_id,
            'fecha_salida'=> $now->toDateString(),
            'hora_salida' => $now->toTimeString(),
        ]);

        // Registrar pago
        Pago::create([
            'monto'      => $request->monto,
            'fecha_pago' => $now->toDateString(),
            'metodo_id'  => $request->metodo_id,
            'ingreso_id' => $request->ingreso_id,
            'membresia_id'=> $ingreso->membresia_id,
        ]);

        // Liberar espacio
        if ($ingreso->espacio) {
            $ingreso->espacio->update(['estado' => 'Disponible']);
        }

        return redirect()->route('admin.salida_vehiculos.index')
            ->with('mensaje', 'Salida y pago registrados. Espacio #' . ($ingreso->espacio->numero ?? '-') . ' liberado.')
            ->with('icono', 'success');
    }

    public function show($id)
    {
        $salida = SalidaVehiculo::with([
            'ingreso.vehiculo.cliente',
            'ingreso.espacio',
            'ingreso.membresia.tipoMembresia',
            'ingreso.pagos.metodoPago',
        ])->findOrFail($id);

        // Calcular tiempo estacionado
        $entrada = Carbon::parse($salida->ingreso->fecha_ingreso . ' ' . $salida->ingreso->hora_ingreso);
        $salidaDt = Carbon::parse($salida->fecha_salida . ' ' . $salida->hora_salida);
        $duracion = $entrada->diff($salidaDt);

        return view('admin.salida_vehiculos.show', compact('salida', 'duracion'));
    }
}
