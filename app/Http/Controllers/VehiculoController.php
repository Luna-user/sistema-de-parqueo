<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\TipoVehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'       => 'required',
            'placa'            => 'required|unique:vehiculos,placa',
            'marca'            => 'required',
            'modelo'           => 'nullable',
            'color'            => 'required',
            'tipo_vehiculo_id' => 'required|exists:tipo_vehiculos,id_tipo_vehiculo',
        ]);

        Vehiculo::create([
            'cliente_id'       => $request->cliente_id,
            'placa'            => strtoupper($request->placa),
            'marca'            => $request->marca,
            'modelo'           => $request->modelo,
            'color'            => $request->color,
            'tipo_vehiculo_id' => $request->tipo_vehiculo_id,
        ]);

        return redirect()->back()
            ->with('mensaje', 'Vehículo registrado exitosamente.')
            ->with('icono', 'success');
    }

    public function show(Vehiculo $vehiculo)
    {
        //
    }

    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $request->validate([
            'cliente_id'       => 'required',
            'placa'            => 'required|unique:vehiculos,placa,' . $id . ',id_vehiculo',
            'marca'            => 'required',
            'modelo'           => 'nullable',
            'color'            => 'required',
            'tipo_vehiculo_id' => 'required|exists:tipo_vehiculos,id_tipo_vehiculo',
        ]);

        $vehiculo->update([
            'cliente_id'       => $request->cliente_id,
            'placa'            => strtoupper($request->placa),
            'marca'            => $request->marca,
            'modelo'           => $request->modelo,
            'color'            => $request->color,
            'tipo_vehiculo_id' => $request->tipo_vehiculo_id,
        ]);

        return redirect()->back()
            ->with('mensaje', 'Vehículo actualizado exitosamente.')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->delete();

        return redirect()->back()
            ->with('mensaje', 'Vehículo eliminado exitosamente.')
            ->with('icono', 'success');
    }
}
