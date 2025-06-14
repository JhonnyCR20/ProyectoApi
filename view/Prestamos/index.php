<?php
require_once __DIR__ . '/../../controller/PrestamoController.php';

$prestamoController = new PrestamoController();
$prestamos = $prestamoController->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préstamos</title>
</head>
<body>
    <h1>Lista de Préstamos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Lector</th>
                <th>Fecha Préstamo</th>
                <th>Fecha Devolución</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestamos as $prestamo): ?>
                <tr>
                    <td><?= $prestamo->id_prestamo ?></td>
                    <td><?= $prestamo->id_lector ?></td>
                    <td><?= $prestamo->fecha_prestamo ?></td>
                    <td><?= $prestamo->fecha_devolucion ?></td>
                    <td><?= $prestamo->estado ?></td>
                    <td>
                        <a href="editar.php?id=<?= $prestamo->id_prestamo ?>">Editar</a>
                        <a href="eliminar.php?id=<?= $prestamo->id_prestamo ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="crear.php">Crear Préstamo</a>
</body>
</html>
