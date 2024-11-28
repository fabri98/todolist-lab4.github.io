<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Fecha Límite</title>
</head>
<body>
    <h1>Notificación de Fecha Límite</h1>
    <p>Tienes una tarea pendiente:</p>
    <ul>
        <li>ID de Tarea: {{ $tarea->id }}</li>
        <li>Nombre de la tarea: {{ $tarea->titulo }}</li>
        <li>Descripción de la tarea: {{ $tarea->descripcion }}</li>
        <li>Fecha límite: {{ $tarea->fecha_limite }}</li>
    </ul>
</body>
</html>
