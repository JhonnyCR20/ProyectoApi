<?php
require_once __DIR__ . '/../../controller/HistorialController.php';

$historialController = new HistorialController();
$historiales = $historialController->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
</head>
<body>
    <h1>Lista de Historial</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Lector</th>
                <th>Acción</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($historiales as $historial): ?>
                <tr>
                    <td><?= $historial->id_historial ?></td>
                    <td><?= $historial->id_lector ?></td>
                    <td><?= $historial->accion ?></td>
                    <td><?= $historial->fecha ?></td>
                    <td>
                        <a href="editar.php?id=<?= $historial->id_historial ?>">Editar</a>
                        <a href="eliminar.php?id=<?= $historial->id_historial ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="crear.php">Crear Historial</a>
</body>
</html>
