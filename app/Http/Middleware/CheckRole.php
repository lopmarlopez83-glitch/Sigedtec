<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Maneja la petición entrante.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role  El nombre del rol requerido (ej: 'admin' o 'solicitante')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Si no hay usuario autenticado, redirigir al login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Si el usuario no tiene el rol requerido, abortar con 403
        if (auth()->user()->role->nombre !== $role) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}