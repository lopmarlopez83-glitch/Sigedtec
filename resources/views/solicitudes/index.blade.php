<!DOCTYPE html>
<html>
<head>
    <title>Solicitudes</title>
</head>
<body>
    <h1>Solicitudes</h1>
    <a href="{{ route('solicitudes.create') }}">Nueva Solicitud</a>

    <ul>
        @forelse($solicitudes as $solicitud)
            <li>
                Oficina: {{ $solicitud->oficina }} -
                Categoría: {{ $solicitud->categoria->nombre }} -
                Cantidad: {{ $solicitud->cantidad_equipos }} -
                Estado: {{ $solicitud->estado }} -
                Solicitante: {{ $solicitud->user->name }}
                <a href="{{ route('solicitudes.show', $solicitud) }}">Ver</a>
            </li>
        @empty
            <li>No hay solicitudes</li>
        @endforelse
    </ul>
</body>
</html>