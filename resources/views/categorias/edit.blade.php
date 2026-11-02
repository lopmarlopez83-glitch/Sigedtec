<!DOCTYPE html>
<html>
<head>
    <title>Editar Categoría</title>
</head>
<body>
    <h1>Editar Categoría</h1>
    <form method="POST" action="{{ route('categorias.update', $categoria) }}">
        @csrf
        @method('PUT')
        <label>Nombre: <input type="text" name="nombre" value="{{ $categoria->nombre }}"></label><br>
        <label>Descripción: <input type="text" name="descripcion" value="{{ $categoria->descripcion }}"></label><br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="{{ route('categorias.index') }}">Volver</a>
</body>
</html>