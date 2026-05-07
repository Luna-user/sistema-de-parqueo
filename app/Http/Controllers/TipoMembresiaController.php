<?php

namespace App\Http\Controllers;

use App\Models\TipoMembresia;
use Illuminate\Http\Request;

class TipoMembresiaController extends Controller
{
    public function index()
    {
        $tipos = TipoMembresia::latest()->get();
        return view('admin.tipo_membresias.index', compact('tipos'));
    }

    public function create()
    {
        return view('admin.tipo_membresias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'nullable|string|max:100',
            'costo'  => 'required|numeric|min:0',
        ]);

        TipoMembresia::create($request->only('nombre', 'costo'));

        return redirect()->route('admin.tipo_membresias.index')
            ->with('mensaje', 'Tipo de membresía registrado exitosamente.')
            ->with('icono', 'success');
    }

    public function edit($id)
    {
        $tipo = TipoMembresia::findOrFail($id);
        return view('admin.tipo_membresias.edit', compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        $tipo = TipoMembresia::findOrFail($id);

        $request->validate([
            'nombre' => 'nullable|string|max:100',
            'costo'  => 'required|numeric|min:0',
        ]);

        $tipo->update($request->only('nombre', 'costo'));

        return redirect()->route('admin.tipo_membresias.index')
            ->with('mensaje', 'Tipo de membresía actualizado exitosamente.')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        $tipo = TipoMembresia::findOrFail($id);

        if ($tipo->membresias()->count() > 0) {
            return redirect()->route('admin.tipo_membresias.index')
                ->with('mensaje', 'No se puede eliminar: existen membresías asociadas a este tipo.')
                ->with('icono', 'error');
        }

        $tipo->delete();

        return redirect()->route('admin.tipo_membresias.index')
            ->with('mensaje', 'Tipo de membresía eliminado exitosamente.')
            ->with('icono', 'success');
    }
}
