<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Transacción</title>
</head>
<body>
    <h1>Notificación de Nueva Transacción</h1>

    <p>Se ha creado una nueva transacción:</p>
    <p><strong>Fecha:</strong> {{ $transaccion->fecha }}</p>
    <p><strong>Usuario:</strong> {{ $transaccion->usuario->nombre }}</p>
    <p><strong>Categoría:</strong> {{ $transaccion->categoria->nombre }}</p>
    <p><strong>Tipo:</strong> {{ ucfirst($transaccion->tipo) }}</p>
    <p><strong>Monto:</strong> ${{ number_format($transaccion->monto, 2) }}</p>
    <p><strong>Descripción:</strong> {{ $transaccion->descripcion }}</p>

    <p>Gracias por usar nuestro sistema.</p>
</body>
</html>
