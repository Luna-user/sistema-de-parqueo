<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function index()
    {
        $bitacoras = Bitacora::latest('id_bitacora')->paginate(50);
        return view('admin.bitacoras.index', compact('bitacoras'));
    }

    public function show($id)
    {
        $bitacora = Bitacora::findOrFail($id);
        return view('admin.bitacoras.show', compact('bitacora'));
    }

    public function destroy($id)
    {
        Bitacora::findOrFail($id)->delete();

        return redirect()->route('admin.bitacoras.index')
            ->with('mensaje', 'Registro de bitácora eliminado.')
            ->with('icono', 'success');
    }

    public function destroyAll()
    {
        Bitacora::truncate();

        return redirect()->route('admin.bitacoras.index')
            ->with('mensaje', 'Bitácora limpiada completamente.')
            ->with('icono', 'success');
    }
}
