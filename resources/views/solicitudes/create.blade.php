<!DOCTYPE html>
<html>
<head>
    <title>Nueva Solicitud</title>
</head>
<body>
    <h1>Nueva Solicitud</h1>
    <form method="POST" action="{{ route('solicitudes.store') }}">
        @csrf
        <label>Oficina: <input type="text" name="oficina" value="{{ old('oficina') }}"></label><br>
        <label>Cantidad de equipos: <input type="number" name="cantidad_equipos" value="{{ old('cantidad_equipos') }}"></label><br>
        <label>Categoría:
            <select name="categoria_id">
                <option value="">Seleccione</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </label><br>
        <button type="submit">Enviar Solicitud</button>
    </form>
    <a href="{{ route('solicitudes.index') }}">Volver</a>
</body>
</html>