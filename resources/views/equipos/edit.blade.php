@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Editar Equipo</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('equipos.update', $equipo) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Código Patrimonial</label>
                    <input type="text" name="codigo_patrimonial" value="{{ $equipo->codigo_patrimonial }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Marca</label>
                    <input type="text" name="marca" value="{{ $equipo->marca }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Modelo</label>
                    <input type="text" name="modelo" value="{{ $equipo->modelo }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">CPU</label>
                    <input type="text" name="cpu" value="{{ $equipo->cpu }}" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">RAM</label>
                    <input type="text" name="ram" value="{{ $equipo->ram }}" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Almacenamiento</label>
                    <input type="text" name="almacenamiento" value="{{ $equipo->almacenamiento }}" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Estado</label>
                    <select name="estado" class="w-full border rounded px-3 py-2" required>
                        <option value="Disponible" {{ $equipo->estado == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="Asignado" {{ $equipo->estado == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                        <option value="En Mantenimiento" {{ $equipo->estado == 'En Mantenimiento' ? 'selected' : '' }}>En Mantenimiento</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Categoría</label>
                    <select name="categoria_id" class="w-full border rounded px-3 py-2" required>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $equipo->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-between mt-4">
                <a href="{{ route('equipos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Volver</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
            </div>
        </form>
    </div>
@endsection