<?php

namespace App\Http\Controllers;

use App\Models\TipoVehiculo;
use Illuminate\Http\Request;

class TipoVehiculoController extends Controller
{
    public function index()
    {
        $tipos = TipoVehiculo::latest()->get();
        return view('admin.tipo_vehiculos.index', compact('tipos'));
    }

    public function create()
    {
        return view('admin.tipo_vehiculos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100|unique:tipo_vehiculos,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        TipoVehiculo::create($request->only('nombre', 'descripcion'));

        return redirect()->route('admin.tipo_vehiculos.index')
            ->with('mensaje', 'Tipo de vehículo registrado exitosamente.')
            ->with('icono', 'success');
    }

    public function edit($id)
    {
        $tipo = TipoVehiculo::findOrFail($id);
        return view('admin.tipo_vehiculos.edit', compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        $tipo = TipoVehiculo::findOrFail($id);

        $request->validate([
            'nombre'      => 'required|string|max:100|unique:tipo_vehiculos,nombre,' . $id . ',id_tipo_vehiculo',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $tipo->update($request->only('nombre', 'descripcion'));

        return redirect()->route('admin.tipo_vehiculos.index')
            ->with('mensaje', 'Tipo de vehículo actualizado exitosamente.')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        $tipo = TipoVehiculo::findOrFail($id);

        if ($tipo->vehiculos()->count() > 0) {
            return redirect()->route('admin.tipo_vehiculos.index')
                ->with('mensaje', 'No se puede eliminar: existen vehículos asociados a este tipo.')
                ->with('icono', 'error');
        }

        $tipo->delete();

        return redirect()->route('admin.tipo_vehiculos.index')
            ->with('mensaje', 'Tipo de vehículo eliminado exitosamente.')
            ->with('icono', 'success');
    }
}
