<!DOCTYPE html>
<html>
<head>
    <title>Equipos</title>
</head>
<body>
    <h1>Equipos</h1>
    <a href="{{ route('equipos.create') }}">Nuevo Equipo</a>

    <ul>
        @forelse($equipos as $equipo)
            <li>
                {{ $equipo->codigo_patrimonial }} - {{ $equipo->marca }} {{ $equipo->modelo }}
                - Categoría: {{ $equipo->categoria->nombre }}
                - Estado: {{ $equipo->estado }}
                <a href="{{ route('equipos.edit', $equipo) }}">Editar</a>
                <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @empty
            <li>No hay equipos</li>
        @endforelse
    </ul>
</body>
</html>