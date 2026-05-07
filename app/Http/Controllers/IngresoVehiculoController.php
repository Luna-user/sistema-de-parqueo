<?php

namespace App\Http\Controllers;

use App\Models\IngresoVehiculo;
use App\Models\Vehiculo;
use App\Models\Espacio;
use App\Models\Membresia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IngresoVehiculoController extends Controller
{
    public function index()
    {
        $ingresos = IngresoVehiculo::with(['vehiculo.cliente', 'espacio', 'membresia', 'salida'])
            ->latest()
            ->get();
        return view('admin.ingreso_vehiculos.index', compact('ingresos'));
    }

    public function create()
    {
        $vehiculos  = Vehiculo::with('cliente')->get();
        $espacios   = Espacio::where('estado', 'Disponible')->get();
        $membresias = Membresia::with('vehiculo.cliente')->get();
        return view('admin.ingreso_vehiculos.create', compact('vehiculos', 'espacios', 'membresias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id'    => 'required|exists:vehiculos,id_vehiculo',
            'espacio_id'     => 'required|exists:espacios,id_espacio',
            'tiene_membresia'=> 'required|boolean',
            'membresia_id'   => 'nullable|exists:membresias,id_membresia',
        ]);

        // Verificar que el espacio esté disponible
        $espacio = Espacio::findOrFail($request->espacio_id);
        if ($espacio->estado !== 'Disponible') {
            return redirect()->back()
                ->with('mensaje', 'El espacio seleccionado no está disponible.')
                ->with('icono', 'error')
                ->withInput();
        }

        $ingreso = IngresoVehiculo::create([
            'vehiculo_id'    => $request->vehiculo_id,
            'espacio_id'     => $request->espacio_id,
            'tiene_membresia'=> $request->tiene_membresia,
            'membresia_id'   => $request->tiene_membresia ? $request->membresia_id : null,
            'fecha_ingreso'  => Carbon::now()->toDateString(),
            'hora_ingreso'   => Carbon::now()->toTimeString(),
        ]);

        // Marcar espacio como ocupado
        $espacio->update(['estado' => 'Ocupado']);

        return redirect()->route('admin.ingreso_vehiculos.index')
            ->with('mensaje', 'Ingreso registrado exitosamente. Espacio #' . $espacio->numero . ' ocupado.')
            ->with('icono', 'success');
    }

    public function show($id)
    {
        $ingreso = IngresoVehiculo::with(['vehiculo.cliente', 'espacio', 'membresia.tipoMembresia', 'salida', 'pagos.metodoPago'])
            ->findOrFail($id);
        return view('admin.ingreso_vehiculos.show', compact('ingreso'));
    }

    public function destroy($id)
    {
        $ingreso = IngresoVehiculo::findOrFail($id);

        // Liberar el espacio
        if ($ingreso->espacio) {
            $ingreso->espacio->update(['estado' => 'Disponible']);
        }

        $ingreso->delete();

        return redirect()->route('admin.ingreso_vehiculos.index')
            ->with('mensaje', 'Ingreso eliminado y espacio liberado.')
            ->with('icono', 'success');
    }

    /**
     * Buscar vehículo por placa (AJAX)
     */
    public function buscarVehiculo($placa)
    {
        $vehiculo = Vehiculo::where('placa', strtoupper($placa))
            ->with(['cliente', 'tipoVehiculo', 'membresias' => function ($q) {
                $q->where('estado', 'Activa')->latest();
            }])
            ->first();

        if (!$vehiculo) {
            return response()->json(['encontrado' => false]);
        }

        return response()->json([
            'encontrado'   => true,
            'id_vehiculo'  => $vehiculo->id_vehiculo,
            'placa'        => $vehiculo->placa,
            'marca'        => $vehiculo->marca,
            'modelo'       => $vehiculo->modelo,
            'color'        => $vehiculo->color,
            'tipo'         => $vehiculo->tipoVehiculo->nombre ?? '-',
            'cliente'      => $vehiculo->cliente->nombres ?? '-',
            'membresia'    => $vehiculo->membresias->first() ? [
                'id'          => $vehiculo->membresias->first()->id_membresia,
                'fecha_fin'   => $vehiculo->membresias->first()->fecha_fin,
            ] : null,
        ]);
    }
}
