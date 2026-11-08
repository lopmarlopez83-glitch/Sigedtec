@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Detalle de Solicitud</h1>

        <div class="mb-4">
            <p><strong>Oficina:</strong> {{ $solicitud->oficina }}</p>
            <p><strong>Categoría:</strong> {{ $solicitud->categoria->nombre ?? 'Sin categoría' }}</p>
            <p><strong>Cantidad solicitada:</strong> {{ $solicitud->cantidad_equipos }}</p>
            <p><strong>Estado:</strong> 
                <span class="px-2 py-1 rounded text-sm 
                    @if($solicitud->estado == 'Pendiente') bg-yellow-100 text-yellow-800
                    @elseif($solicitud->estado == 'Aprobada') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ $solicitud->estado }}
                </span>
            </p>
            <p><strong>Solicitante:</strong> {{ $solicitud->user->name }}</p>
        </div>

        @if($solicitud->estado == 'Pendiente' && auth()->user()->role && auth()->user()->role->nombre === 'admin')
            <div class="border-t pt-4 mt-4">
                <h2 class="text-xl font-bold mb-2">Aprobar / Rechazar</h2>
                <form method="POST" action="{{ route('solicitudes.aprobar', $solicitud) }}" class="mb-4">
                    @csrf
                    <label class="block font-bold mb-2">Seleccione los equipos a asignar:</label>
                    <div class="mb-2 max-h-48 overflow-y-auto border p-2 rounded">
                        @php
                            $equiposDisponibles = \App\Models\Equipo::where('categoria_id', $solicitud->categoria_id)
                                ->where('estado', 'Disponible')
                                ->get();
                        @endphp
                        @forelse($equiposDisponibles as $equipo)
                            <label class="block">
                                <input type="checkbox" name="equipos[]" value="{{ $equipo->id }}" class="mr-2">
                                {{ $equipo->codigo_patrimonial }} - {{ $equipo->marca }} {{ $equipo->modelo }}
                            </label>
                        @empty
                            <p class="text-red-600">No hay equipos disponibles en esta categoría.</p>
                        @endforelse
                    </div>
                    @if($equiposDisponibles->isNotEmpty())
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Aprobar y Asignar</button>
                    @endif
                </form>

                <form method="POST" action="{{ route('solicitudes.rechazar', $solicitud) }}">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('¿Rechazar solicitud?')">Rechazar Solicitud</button>
                </form>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('solicitudes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Volver</a>
        </div>
    </div>
@endsection