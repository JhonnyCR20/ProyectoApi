<?php
require_once __DIR__ . '/../../controller/EditorialController.php';

$editorialController = new EditorialController();
$editoriales = $editorialController->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editoriales</title>
</head>
<body>
    <h1>Lista de Editoriales</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>País</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($editoriales as $editorial): ?>
                <tr>
                    <td><?= $editorial->id_editorial ?></td>
                    <td><?= $editorial->nombre ?></td>
                    <td><?= $editorial->pais ?></td>
                    <td>
                        <a href="editar.php?id=<?= $editorial->id_editorial ?>">Editar</a>
                        <a href="eliminar.php?id=<?= $editorial->id_editorial ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="crear.php">Crear Editorial</a>
</body>
</html>
