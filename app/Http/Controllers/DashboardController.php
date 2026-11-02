<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Solicitud;

class DashboardController extends Controller
{
    public function index()
    {
        $disponibles = Equipo::where('estado', 'Disponible')->count();
        $mantenimiento = Equipo::where('estado', 'En Mantenimiento')->count();
        $pendientes = Solicitud::where('estado', 'Pendiente')->count();

        return view('dashboard', compact('disponibles', 'mantenimiento', 'pendientes'));
    }
}