<!DOCTYPE html>
<html>
<head>
    <title>Asignaciones</title>
</head>
<body>
    <h1>Asignaciones</h1>
    <ul>
        @forelse($asignaciones as $asignacion)
            <li>
                Solicitud #{{ $asignacion->solicitud_id }} -
                Equipo: {{ $asignacion->equipo->codigo_patrimonial }} ({{ $asignacion->equipo->marca }}) -
                Fecha: {{ $asignacion->fecha_asignacion }}
            </li>
        @empty
            <li>No hay asignaciones</li>
        @endforelse
    </ul>
</body>
</html>