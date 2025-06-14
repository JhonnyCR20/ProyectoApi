<?php
require_once __DIR__ . '/../../controller/CategoriaController.php';

$categoriaController = new CategoriaController();
$categorias = $categoriaController->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
</head>
<body>
    <h1>Lista de Categorías</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td><?= $categoria->id_categoria ?></td>
                    <td><?= $categoria->nombre ?></td>
                    <td><?= $categoria->descripcion ?></td>
                    <td>
                        <a href="editar.php?id=<?= $categoria->id_categoria ?>">Editar</a>
                        <a href="eliminar.php?id=<?= $categoria->id_categoria ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="crear.php">Crear Categoría</a>
</body>
</html>
