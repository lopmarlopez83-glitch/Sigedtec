<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Listar todos los usuarios (solo admin)
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    // Mostrar formulario para editar el rol de un usuario
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Actualizar el rol del usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update(['role_id' => $request->role_id]);

        return redirect()->route('users.index')->with('success', 'Rol actualizado correctamente.');
    }
}