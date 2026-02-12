<?php

namespace App\Http\Controllers;
use App\Models\Ajuste;
use App\Models\Tarifa;
use Illuminate\Http\Request;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ajuste = Ajuste::first();
        $tarifas = Tarifa::all();
        return view('admin.tarifas.index', compact('tarifas', 'ajuste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tarifas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'cantidad' => 'required',
            'costo' => 'required',
            'minutos_de_gracia' => 'required',
        ]);

        $tarifa = new Tarifa();
        $tarifa->nombre = $request->nombre;
        $tarifa->tipo = $request->tipo;
        $tarifa->cantidad = $request->cantidad;
        $tarifa->costo = $request->costo;
        $tarifa->minutos_de_gracia = $request->minutos_de_gracia;
        $tarifa->save();

        return redirect()->route('admin.tarifas.index')
            ->with('mensaje', 'Tarifa creada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarifa $tarifa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tarifa = Tarifa::find($id);
        return view('admin.tarifas.edit', compact('tarifa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tarifa = Tarifa::find($id);

        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'cantidad' => 'required',
            'costo' => 'required',
            'minutos_de_gracia' => 'required',
        ]);

        $tarifa->nombre = $request->nombre;
        $tarifa->tipo = $request->tipo;
        $tarifa->cantidad = $request->cantidad;
        $tarifa->costo = $request->costo;
        $tarifa->minutos_de_gracia = $request->minutos_de_gracia;
        $tarifa->save();

        return redirect()->route('admin.tarifas.index')
            ->with('mensaje', 'Tarifa actualizada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tarifa = Tarifa::find($id);
        $tarifa->delete();
        return redirect()->route('admin.tarifas.index')
            ->with('mensaje', 'Tarifa eliminada exitosamente')
            ->with('icono', 'success');
    }
}
