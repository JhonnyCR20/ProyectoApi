<?php
require_once __DIR__ . '/../../controller/UsuarioController.php';

$usuarioController = new UsuarioController();
$usuarios = $usuarioController->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id_usuario'] ?></td>
                    <td><?= $usuario['nombre'] ?></td>
                    <td><?= $usuario['correo'] ?></td>
                    <td><?= $usuario['rol'] ?></td>
                    <td>
                        <a href="editar.php?id=<?= $usuario['id_usuario'] ?>">Editar</a>
                        <a href="eliminar.php?id=<?= $usuario['id_usuario'] ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="crear.php">Crear Usuario</a>
</body>
</html>
