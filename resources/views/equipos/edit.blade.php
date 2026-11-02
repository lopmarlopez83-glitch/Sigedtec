<!DOCTYPE html>
<html>
<head>
    <title>Editar Equipo</title>
</head>
<body>
    <h1>Editar Equipo</h1>
    <form method="POST" action="{{ route('equipos.update', $equipo) }}">
        @csrf
        @method('PUT')
        <label>Código Patrimonial: <input type="text" name="codigo_patrimonial" value="{{ $equipo->codigo_patrimonial }}"></label><br>
        <label>Marca: <input type="text" name="marca" value="{{ $equipo->marca }}"></label><br>
        <label>Modelo: <input type="text" name="modelo" value="{{ $equipo->modelo }}"></label><br>
        <label>CPU: <input type="text" name="cpu" value="{{ $equipo->cpu }}"></label><br>
        <label>RAM: <input type="text" name="ram" value="{{ $equipo->ram }}"></label><br>
        <label>Almacenamiento: <input type="text" name="almacenamiento" value="{{ $equipo->almacenamiento }}"></label><br>
        <label>Estado:
            <select name="estado">
                <option value="Disponible" {{ $equipo->estado == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Asignado" {{ $equipo->estado == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                <option value="En Mantenimiento" {{ $equipo->estado == 'En Mantenimiento' ? 'selected' : '' }}>En Mantenimiento</option>
            </select>
        </label><br>
        <label>Categoría:
            <select name="categoria_id">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $equipo->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </label><br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="{{ route('equipos.index') }}">Volver</a>
</body>
</html>