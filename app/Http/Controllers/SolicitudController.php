<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Categoria;
use App\Models\Equipo;
use App\Models\Asignacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudController extends Controller
{
    public function index()
    {
        // 🔽 with para evitar N+1
        $solicitudes = Solicitud::with(['user', 'categoria'])->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('solicitudes.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'oficina' => 'required|string|max:255',
            'cantidad_equipos' => 'required|integer|min:1',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Solicitud::create([
            'oficina' => $request->oficina,
            'cantidad_equipos' => $request->cantidad_equipos,
            'estado' => 'Pendiente',
            'user_id' => auth()->id(), // el usuario autenticado
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('solicitudes.index');
    }

    public function show(Solicitud $solicitud)
{
    // 🔽 Carga las relaciones necesarias
    $solicitud->load(['user', 'categoria', 'asignaciones.equipo']);
    return view('solicitudes.show', compact('solicitud'));
}
    public function edit(Solicitud $solicitud)
    {
        $categorias = Categoria::all();
        return view('solicitudes.edit', compact('solicitud', 'categorias'));
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'oficina' => 'required|string|max:255',
            'cantidad_equipos' => 'required|integer|min:1',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $solicitud->update($request->all());
        return redirect()->route('solicitudes.index');
    }

    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();
        return redirect()->route('solicitudes.index');
    }

    // 🔽 APROBAR SOLICITUD (con transacción)
    public function aprobar(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'equipos' => 'required|array|min:1',
            'equipos.*' => 'exists:equipos,id',
        ]);

        // Verificar que la cantidad de equipos coincida
        if (count($request->equipos) != $solicitud->cantidad_equipos) {
            return back()->withErrors(['equipos' => 'Debe asignar exactamente ' . $solicitud->cantidad_equipos . ' equipos.']);
        }

        DB::transaction(function () use ($request, $solicitud) {
            // Cambiar estado de la solicitud
            $solicitud->update([
                'estado' => 'Aprobada',
                'fecha_respuesta' => now(),
            ]);

            // Asignar equipos
            foreach ($request->equipos as $equipoId) {
                $equipo = Equipo::find($equipoId);
                $equipo->update(['estado' => 'Asignado']);

                Asignacion::create([
                    'solicitud_id' => $solicitud->id,
                    'equipo_id' => $equipoId,
                    'fecha_asignacion' => now(),
                ]);
            }
        });

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud aprobada y equipos asignados.');
    }

    // 🔽 RECHAZAR SOLICITUD
    public function rechazar(Solicitud $solicitud)
    {
        $solicitud->update([
            'estado' => 'Rechazada',
            'fecha_respuesta' => now(),
        ]);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud rechazada.');
    }
}