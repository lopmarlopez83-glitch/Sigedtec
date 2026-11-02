<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <ul>
        <li>Equipos disponibles: {{ $disponibles }}</li>
        <li>Equipos en mantenimiento: {{ $mantenimiento }}</li>
        <li>Solicitudes pendientes: {{ $pendientes }}</li>
    </ul>
</body>
</html>