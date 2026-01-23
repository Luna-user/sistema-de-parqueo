<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AjusteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ajuste = Ajuste::first();
        return view('admin.ajustes.index',compact('ajuste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $ajuste = Ajuste::first();
        //return response()->json($request->all());
        $rules = [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'sucursal' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'divisa' => 'required|string|max:10',
            'correo_electronico' => 'required|email|max:255',
            'pagina_web' => 'nullable|url|max:255',
        ];
        if (!$ajuste || !$ajuste->logo ) {
            $rules['logo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }else{
            $rules['logo'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        if (!$ajuste || !$ajuste->logo_auto ) {
            $rules['logo_auto'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }else{
            $rules['logo_auto'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $request->validate($rules);
        
        if (!$ajuste) {
            $ajuste = new Ajuste();
        }
        $ajuste->nombre = $request->nombre;
        $ajuste->descripcion = $request->descripcion;
        $ajuste->sucursal = $request->sucursal;
        $ajuste->direccion = $request->direccion;
        $ajuste->telefono = $request->telefono;
        $ajuste->divisa = $request->divisa;
        $ajuste->correo_electronico = $request->correo_electronico;
        $ajuste->pagina_web = $request->pagina_web;

        //Guardas el logo
        if ($request->hasFile('logo')) {
            if ($ajuste->logo && Storage::disk('public')->exists('logos/'.$ajuste->logo)) {
                Storage::disk('public')->delete('logos/'.$ajuste->logo);
            }
            $logoPath = $request->file('logo')->store('logos','public');
            $ajuste->logo = basename($logoPath);
        }

        if ($request->hasFile('logo_auto')) {
            if ($ajuste->logo_auto && Storage::disk('public')->exists('logos/'.$ajuste->logo_auto)) {
                Storage::disk('public')->delete('logos/'.$ajuste->logo_auto);
            }
            $logoAutoPath = $request->file('logo_auto')->store('logos','public');
            $ajuste->logo_auto = basename($logoAutoPath);
        }

        $ajuste->save();

        return redirect()->back()
        ->with('mensaje', 'Ajustes guardados correctamente.')
        ->with('icono', 'success');
    }
    /**
     * Display the specified resource.
     */
    public function show(Ajuste $ajuste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ajuste $ajuste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ajuste $ajuste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ajuste $ajuste)
    {
        //
    }
}
