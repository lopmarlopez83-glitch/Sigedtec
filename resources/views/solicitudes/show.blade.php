<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Solicitud</title>
</head>
<body>
    <h1>Detalle de Solicitud</h1>

    <p><strong>Oficina:</strong> {{ $solicitud->oficina }}</p>
    <p><strong>Categoría:</strong> {{ $solicitud->categoria->nombre }}</p>
    <p><strong>Cantidad:</strong> {{ $solicitud->cantidad_equipos }}</p>
    <p><strong>Estado:</strong> {{ $solicitud->estado }}</p>
    <p><strong>Solicitante:</strong> {{ $solicitud->user->name }}</p>

    @if($solicitud->estado == 'Pendiente')
        <h2>Aprobar / Rechazar</h2>
        <form method="POST" action="{{ route('solicitudes.aprobar', $solicitud) }}">
            @csrf
            <label>Seleccione los equipos a asignar:</label><br>
            @foreach(\App\Models\Equipo::where('categoria_id', $solicitud->categoria_id)->where('estado', 'Disponible')->get() as $equipo)
                <label>
                    <input type="checkbox" name="equipos[]" value="{{ $equipo->id }}">
                    {{ $equipo->codigo_patrimonial }} - {{ $equipo->marca }} {{ $equipo->modelo }}
                </label><br>
            @endforeach
            <button type="submit">Aprobar y Asignar</button>
        </form>

        <form method="POST" action="{{ route('solicitudes.rechazar', $solicitud) }}">
            @csrf
            <button type="submit">Rechazar Solicitud</button>
        </form>
    @endif

    <a href="{{ route('solicitudes.index') }}">Volver</a>
</body>
</html>