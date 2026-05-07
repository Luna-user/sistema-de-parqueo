<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    public function index()
    {
        $metodos = MetodoPago::latest()->get();
        return view('admin.metodo_pagos.index', compact('metodos'));
    }

    public function create()
    {
        return view('admin.metodo_pagos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:metodo_pagos,nombre',
        ]);

        MetodoPago::create($request->only('nombre'));

        return redirect()->route('admin.metodo_pagos.index')
            ->with('mensaje', 'Método de pago registrado exitosamente.')
            ->with('icono', 'success');
    }

    public function edit($id)
    {
        $metodo = MetodoPago::findOrFail($id);
        return view('admin.metodo_pagos.edit', compact('metodo'));
    }

    public function update(Request $request, $id)
    {
        $metodo = MetodoPago::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100|unique:metodo_pagos,nombre,' . $id . ',id_metodo',
        ]);

        $metodo->update($request->only('nombre'));

        return redirect()->route('admin.metodo_pagos.index')
            ->with('mensaje', 'Método de pago actualizado exitosamente.')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        $metodo = MetodoPago::findOrFail($id);

        if ($metodo->pagos()->count() > 0) {
            return redirect()->route('admin.metodo_pagos.index')
                ->with('mensaje', 'No se puede eliminar: existen pagos asociados a este método.')
                ->with('icono', 'error');
        }

        $metodo->delete();

        return redirect()->route('admin.metodo_pagos.index')
            ->with('mensaje', 'Método de pago eliminado exitosamente.')
            ->with('icono', 'success');
    }
}
