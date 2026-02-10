<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\Espacio;
use Illuminate\Http\Request;

class EspacioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ajuste = Ajuste::first();
        $espacios = Espacio::all();
        return view('admin.espacios.index', compact('espacios','ajuste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.espacios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:espacios',
            'estado' => 'required',
        ]);

        $espacio = new Espacio();
        $espacio->numero = $request->numero;
        $espacio->estado = $request->estado;
        $espacio->save();
        return redirect()->route('admin.espacios.index')
            ->with('mensaje', 'Espacio creado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Espacio $espacio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Espacio $espacio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $espacio = Espacio::find($id);
        $espacio->estado = $request->estado;
        $espacio->save();
        return redirect()->route('admin.espacios.index')
            ->with('mensaje', 'Estado del espacio actualizado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Espacio $espacio)
    {
        //
    }
}
