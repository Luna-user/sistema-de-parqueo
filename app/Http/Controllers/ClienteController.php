<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::withTrashed()->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'numero_documento' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'genero' => 'required',
        ]);

        $cliente = new Cliente();
        $cliente->nombres = $request->nombres;
        $cliente->numero_documento = $request->numero_documento;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->genero = $request->genero;
        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente registrado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        
        $request->validate([
            'nombres' => 'required',
            'numero_documento' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'genero' => 'required',
        ]);

        $cliente->nombres = $request->nombres;
        $cliente->numero_documento = $request->numero_documento;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->genero = $request->genero;
        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente actualizado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        $cliente->estado = false;
        $cliente->save();
        $cliente->delete();
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente eliminado exitosamente')
            ->with('icono', 'success');
    }
    public function restore($id)
    {
        $cliente = Cliente::withTrashed()->find($id);
        $cliente->restore();
        $cliente->estado = true;
        $cliente->save();
        
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente restaurado exitosamente')
            ->with('icono', 'success');
    }
}
