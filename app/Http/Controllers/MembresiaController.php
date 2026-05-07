<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use App\Models\Vehiculo;
use App\Models\TipoMembresia;
use Illuminate\Http\Request;

class MembresiaController extends Controller
{
    public function index()
    {
        $membresias = Membresia::with(['vehiculo.cliente', 'tipoMembresia'])->latest()->get();
        return view('admin.membresias.index', compact('membresias'));
    }

    public function create()
    {
        $vehiculos     = Vehiculo::with('cliente')->get();
        $tipoMembresias = TipoMembresia::all();
        return view('admin.membresias.create', compact('vehiculos', 'tipoMembresias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id'       => 'required|exists:vehiculos,id_vehiculo',
            'tipo_membresia_id' => 'required|exists:tipo_membresias,id_tipo_membresia',
            'fecha_inicio'      => 'required|date',
            'fecha_fin'         => 'required|date|after:fecha_inicio',
            'estado'            => 'required|in:Activa,Vencida,Suspendida',
        ]);

        Membresia::create($request->only(
            'vehiculo_id', 'tipo_membresia_id', 'fecha_inicio', 'fecha_fin', 'estado'
        ));

        return redirect()->route('admin.membresias.index')
            ->with('mensaje', 'Membresía registrada exitosamente.')
            ->with('icono', 'success');
    }

    public function show($id)
    {
        $membresia = Membresia::with(['vehiculo.cliente', 'tipoMembresia', 'pagos.metodoPago'])->findOrFail($id);
        return view('admin.membresias.show', compact('membresia'));
    }

    public function edit($id)
    {
        $membresia     = Membresia::findOrFail($id);
        $vehiculos     = Vehiculo::with('cliente')->get();
        $tipoMembresias = TipoMembresia::all();
        return view('admin.membresias.edit', compact('membresia', 'vehiculos', 'tipoMembresias'));
    }

    public function update(Request $request, $id)
    {
        $membresia = Membresia::findOrFail($id);

        $request->validate([
            'vehiculo_id'       => 'required|exists:vehiculos,id_vehiculo',
            'tipo_membresia_id' => 'required|exists:tipo_membresias,id_tipo_membresia',
            'fecha_inicio'      => 'required|date',
            'fecha_fin'         => 'required|date|after:fecha_inicio',
            'estado'            => 'required|in:Activa,Vencida,Suspendida',
        ]);

        $membresia->update($request->only(
            'vehiculo_id', 'tipo_membresia_id', 'fecha_inicio', 'fecha_fin', 'estado'
        ));

        return redirect()->route('admin.membresias.index')
            ->with('mensaje', 'Membresía actualizada exitosamente.')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        $membresia = Membresia::findOrFail($id);
        $membresia->delete();

        return redirect()->route('admin.membresias.index')
            ->with('mensaje', 'Membresía eliminada exitosamente.')
            ->with('icono', 'success');
    }
}
