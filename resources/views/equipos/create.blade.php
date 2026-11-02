<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Equipo</title>
</head>
<body>
    <h1>Nuevo Equipo</h1>
    <form method="POST" action="{{ route('equipos.store') }}">
        @csrf
        <label>Código Patrimonial: <input type="text" name="codigo_patrimonial" value="{{ old('codigo_patrimonial') }}"></label><br>
        <label>Marca: <input type="text" name="marca" value="{{ old('marca') }}"></label><br>
        <label>Modelo: <input type="text" name="modelo" value="{{ old('modelo') }}"></label><br>
        <label>CPU: <input type="text" name="cpu" value="{{ old('cpu') }}"></label><br>
        <label>RAM: <input type="text" name="ram" value="{{ old('ram') }}"></label><br>
        <label>Almacenamiento: <input type="text" name="almacenamiento" value="{{ old('almacenamiento') }}"></label><br>
        <label>Estado:
            <select name="estado">
                <option value="">Seleccione</option>
                <option value="Disponible" {{ old('estado') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Asignado" {{ old('estado') == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                <option value="En Mantenimiento" {{ old('estado') == 'En Mantenimiento' ? 'selected' : '' }}>En Mantenimiento</option>
            </select>
        </label><br>
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
        <button type="submit">Guardar</button>
    </form>
    <a href="{{ route('equipos.index') }}">Volver</a>
</body>
</html>