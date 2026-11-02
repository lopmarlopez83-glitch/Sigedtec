<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>
</head>
<body>
    <h1>Categorías</h1>
    <a href="{{ route('categorias.create') }}">Nueva Categoría</a>

    <ul>
        @forelse($categorias as $categoria)
            <li>
                {{ $categoria->nombre }} - {{ $categoria->descripcion }}
                <a href="{{ route('categorias.edit', $categoria) }}">Editar</a>
                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @empty
            <li>No hay categorías</li>
        @endforelse
    </ul>
</body>
</html>