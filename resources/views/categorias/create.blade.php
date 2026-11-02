<!DOCTYPE html>
<html>
<head>
    <title>Nueva Categoría</title>
</head>
<body>
    <h1>Nueva Categoría</h1>
    <form method="POST" action="{{ route('categorias.store') }}">
        @csrf
        <label>Nombre: <input type="text" name="nombre" value="{{ old('nombre') }}"></label><br>
        <label>Descripción: <input type="text" name="descripcion" value="{{ old('descripcion') }}"></label><br>
        <button type="submit">Guardar</button>
    </form>
    <a href="{{ route('categorias.index') }}">Volver</a>
</body>
</html>