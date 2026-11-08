@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Equipos</h1>
            <a href="{{ route('equipos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nuevo Equipo</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Código</th>
                    <th class="py-2 px-4 border-b text-left">Marca / Modelo</th>
                    <th class="py-2 px-4 border-b text-left">Categoría</th>
                    <th class="py-2 px-4 border-b text-left">Estado</th>
                    <th class="py-2 px-4 border-b text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipos as $equipo)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $equipo->codigo_patrimonial }}</td>
                        <td class="py-2 px-4 border-b">{{ $equipo->marca }} {{ $equipo->modelo }}</td>
                        <td class="py-2 px-4 border-b">{{ $equipo->categoria->nombre }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="px-2 py-1 rounded text-sm 
                                @if($equipo->estado == 'Disponible') bg-green-100 text-green-800
                                @elseif($equipo->estado == 'Asignado') bg-blue-100 text-blue-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ $equipo->estado }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('equipos.edit', $equipo) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                            <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar equipo?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4">No hay equipos</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection