<?php
require_once __DIR__ . '/../../controller/MultaController.php';

$multaController = new MultaController();
$multas = $multaController->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multas</title>
</head>
<body>
    <h1>Lista de Multas</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Préstamo</th>
                <th>Monto</th>
                <th>Pagado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($multas as $multa): ?>
                <tr>
                    <td><?= $multa->id_multa ?></td>
                    <td><?= $multa->id_prestamo ?></td>
                    <td><?= $multa->monto ?></td>
                    <td><?= $multa->pagado ? 'Sí' : 'No' ?></td>
                    <td>
                        <a href="editar.php?id=<?= $multa->id_multa ?>">Editar</a>
                        <a href="eliminar.php?id=<?= $multa->id_multa ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="crear.php">Crear Multa</a>
</body>
</html>
