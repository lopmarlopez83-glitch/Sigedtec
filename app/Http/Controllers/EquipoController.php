<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Categoria;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        // 🔽 with('categoria') para evitar N+1
        $equipos = Equipo::with('categoria')->get();
        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('equipos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_patrimonial' => 'required|string|max:255|unique:equipos,codigo_patrimonial',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cpu' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'almacenamiento' => 'nullable|string|max:255',
            'estado' => 'required|in:Disponible,Asignado,En Mantenimiento',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Equipo::create($request->all());
        return redirect()->route('equipos.index');
    }

    public function show(Equipo $equipo)
    {
        return view('equipos.show', compact('equipo'));
    }

    public function edit(Equipo $equipo)
    {
        $categorias = Categoria::all();
        return view('equipos.edit', compact('equipo', 'categorias'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'codigo_patrimonial' => 'required|string|max:255|unique:equipos,codigo_patrimonial,' . $equipo->id,
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cpu' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'almacenamiento' => 'nullable|string|max:255',
            'estado' => 'required|in:Disponible,Asignado,En Mantenimiento',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $equipo->update($request->all());
        return redirect()->route('equipos.index');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete(); // SoftDelete
        return redirect()->route('equipos.index');
    }
}