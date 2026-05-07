<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\MetodoPago;
use App\Models\Membresia;
use App\Models\IngresoVehiculo;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with(['metodoPago', 'membresia.vehiculo.cliente', 'ingreso.vehiculo.cliente'])
            ->latest()
            ->get();
        return view('admin.pagos.index', compact('pagos'));
    }

    public function create()
    {
        $metodos   = MetodoPago::all();
        $membresias = Membresia::where('estado', 'Activa')->with('vehiculo.cliente')->get();
        $ingresos  = IngresoVehiculo::doesntHave('salida')->with('vehiculo.cliente')->get();
        return view('admin.pagos.create', compact('metodos', 'membresias', 'ingresos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'monto'        => 'required|numeric|min:0',
            'fecha_pago'   => 'required|date',
            'metodo_id'    => 'required|exists:metodo_pagos,id_metodo',
            'membresia_id' => 'nullable|exists:membresias,id_membresia',
            'ingreso_id'   => 'nullable|exists:ingreso_vehiculos,id_ingreso',
        ]);

        Pago::create($request->only('monto', 'fecha_pago', 'metodo_id', 'membresia_id', 'ingreso_id'));

        return redirect()->route('admin.pagos.index')
            ->with('mensaje', 'Pago registrado exitosamente.')
            ->with('icono', 'success');
    }

    public function show($id)
    {
        $pago = Pago::with([
            'metodoPago',
            'membresia.vehiculo.cliente',
            'membresia.tipoMembresia',
            'ingreso.vehiculo.cliente',
            'ingreso.espacio',
        ])->findOrFail($id);
        return view('admin.pagos.show', compact('pago'));
    }

    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        return redirect()->route('admin.pagos.index')
            ->with('mensaje', 'Pago eliminado exitosamente.')
            ->with('icono', 'success');
    }
}
