@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Asignaciones</h1>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Solicitud #</th>
                    <th class="py-2 px-4 border-b text-left">Equipo</th>
                    <th class="py-2 px-4 border-b text-left">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($asignaciones as $asignacion)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $asignacion->solicitud_id }}</td>
                        <td class="py-2 px-4 border-b">{{ $asignacion->equipo->codigo_patrimonial }} ({{ $asignacion->equipo->marca }})</td>
                        <td class="py-2 px-4 border-b">{{ $asignacion->fecha_asignacion }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-4">No hay asignaciones</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection