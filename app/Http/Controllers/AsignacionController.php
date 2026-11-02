<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public function index()
    {
        $asignaciones = Asignacion::with(['solicitud', 'equipo'])->get();
        return view('asignaciones.index', compact('asignaciones'));
    }

    public function show(Asignacion $asignacion)
    {
        $asignacion->load(['solicitud', 'equipo']);
        return view('asignaciones.show', compact('asignacion'));
    }

    // Los demás métodos no se usan porque las asignaciones se crean al aprobar solicitudes
    public function create() { abort(404); }
    public function store(Request $request) { abort(404); }
    public function edit(Asignacion $asignacion) { abort(404); }
    public function update(Request $request, Asignacion $asignacion) { abort(404); }
    public function destroy(Asignacion $asignacion) { abort(404); }
}