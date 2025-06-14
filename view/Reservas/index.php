<?php
require_once __DIR__ . '/../../controller/ReservaController.php';

$reservaController = new ReservaController();
$reservas = $reservaController->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
</head>
<body>
    <h1>Lista de Reservas</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Lector</th>
                <th>ID Libro</th>
                <th>Fecha Reserva</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td><?= $reserva->id_reserva ?></td>
                    <td><?= $reserva->id_lector ?></td>
                    <td><?= $reserva->id_libro ?></td>
                    <td><?= $reserva->fecha_reserva ?></td>
                    <td><?= $reserva->estado ?></td>
                    <td>
                        <a href="editar.php?id=<?= $reserva->id_reserva ?>">Editar</a>
                        <a href="eliminar.php?id=<?= $reserva->id_reserva ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="crear.php">Crear Reserva</a>
</body>
</html>
