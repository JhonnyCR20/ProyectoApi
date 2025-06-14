<?php
require_once __DIR__ . '/../../controller/AutorController.php';

$autorController = new AutorController();
$autores = $autorController->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>
</head>
<body>
    <h1>Lista de Autores</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Nacionalidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($autores as $autor): ?>
                <tr>
                    <td><?= $autor->id_autor ?></td>
                    <td><?= $autor->nombre ?></td>
                    <td><?= $autor->nacionalidad ?></td>
                    <td>
                        <a href="editar.php?id=<?= $autor->id_autor ?>">Editar</a>
                        <a href="eliminar.php?id=<?= $autor->id_autor ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="crear.php">Crear Autor</a>
</body>
</html>
