@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Solicitudes</h1>
            <a href="{{ route('solicitudes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nueva Solicitud</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Oficina</th>
                    <th class="py-2 px-4 border-b text-left">Categoría</th>
                    <th class="py-2 px-4 border-b text-left">Cantidad</th>
                    <th class="py-2 px-4 border-b text-left">Estado</th>
                    <th class="py-2 px-4 border-b text-left">Solicitante</th>
                    <th class="py-2 px-4 border-b text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($solicitudes as $solicitud)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $solicitud->oficina }}</td>
                        <td class="py-2 px-4 border-b">{{ $solicitud->categoria->nombre }}</td>
                        <td class="py-2 px-4 border-b">{{ $solicitud->cantidad_equipos }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="px-2 py-1 rounded text-sm 
                                @if($solicitud->estado == 'Pendiente') bg-yellow-100 text-yellow-800
                                @elseif($solicitud->estado == 'Aprobada') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $solicitud->estado }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b">{{ $solicitud->user->name }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('solicitudes.show', $solicitud) }}" class="text-blue-600 hover:underline">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4">No hay solicitudes</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection