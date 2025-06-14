<?php
require_once __DIR__ . '/../../controller/DetallePrestamoController.php';

$detallePrestamoController = new DetallePrestamoController();
$detalles = $detallePrestamoController->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Préstamos</title>
</head>
<body>
    <h1>Lista de Detalles de Préstamos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Préstamo</th>
                <th>ID Libro</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $detalle): ?>
                <tr>
                    <td><?= $detalle->id_detalle ?></td>
                    <td><?= $detalle->id_prestamo ?></td>
                    <td><?= $detalle->id_libro ?></td>
                    <td><?= $detalle->cantidad ?></td>
                    <td>
                        <a href="editar.php?id=<?= $detalle->id_detalle ?>">Editar</a>
                        <a href="eliminar.php?id=<?= $detalle->id_detalle ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="crear.php">Crear Detalle</a>
</body>
</html>
