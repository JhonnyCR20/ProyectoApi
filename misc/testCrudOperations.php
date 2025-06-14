<?php
require_once __DIR__ . '/../accessoDatos/UsuarioDAO.php';
require_once __DIR__ . '/../accessoDatos/AutorDAO.php';
require_once __DIR__ . '/../accessoDatos/EditorialDAO.php';
require_once __DIR__ . '/../accessoDatos/CategoriaDAO.php';

function testUsuarioDAO() {
    $dao = new UsuarioDAO();

    // Create
    $newUser = [
        'nombre' => 'Test User',
        'correo' => 'testuser@example.com',
        'clave' => 'password123',
        'rol' => 'user'
    ];
    $userId = $dao->crear($newUser);
    echo "Usuario creado con ID: $userId\n";

    // Edit
    $updatedUser = [
        'nombre' => 'Updated User',
        'correo' => 'updateduser@example.com'
    ];
    $result = $dao->actualizar($userId, $updatedUser);
    echo "Usuario actualizado: " . ($result ? 'Éxito' : 'Fallo') . "\n";

    // Delete
    $result = $dao->eliminar($userId);
    echo "Usuario eliminado: " . ($result ? 'Éxito' : 'Fallo') . "\n";
}

function testAutorDAO() {
    $dao = new AutorDAO();

    // Create
    $newAutor = new Autor(null, 'Test Autor', 'Test Nacionalidad');
    $result = $dao->insert($newAutor);
    echo "Autor creado: " . ($result ? 'Éxito' : 'Fallo') . "\n";

    // Edit
    $newAutor->setNombre('Updated Autor');
    $newAutor->setNacionalidad('Updated Nacionalidad');
    $result = $dao->update($newAutor);
    echo "Autor actualizado: " . ($result ? 'Éxito' : 'Fallo') . "\n";

    // Delete
    $result = $dao->delete($newAutor->getIdAutor());
    echo "Autor eliminado: " . ($result ? 'Éxito' : 'Fallo') . "\n";
}

function testEditorialDAO() {
    $dao = new EditorialDAO();

    // Create
    $newEditorial = new Editorial(null, 'Test Editorial', 'Test País');
    $result = $dao->insert($newEditorial);
    echo "Editorial creada: " . ($result ? 'Éxito' : 'Fallo') . "\n";

    // Edit
    $newEditorial->setNombre('Updated Editorial');
    $newEditorial->setPais('Updated País');
    $result = $dao->update($newEditorial);
    echo "Editorial actualizada: " . ($result ? 'Éxito' : 'Fallo') . "\n";

    // Delete
    $result = $dao->delete($newEditorial->getIdEditorial());
    echo "Editorial eliminada: " . ($result ? 'Éxito' : 'Fallo') . "\n";
}

function testCategoriaDAO() {
    $dao = new CategoriaDAO();

    // Create
    $newCategoria = new Categoria(null, 'Test Categoria', 'Test Descripción');
    $result = $dao->insert($newCategoria);
    echo "Categoría creada: " . ($result ? 'Éxito' : 'Fallo') . "\n";

    // Edit
    $newCategoria->setNombre('Updated Categoria');
    $newCategoria->setDescripcion('Updated Descripción');
    $result = $dao->update($newCategoria);
    echo "Categoría actualizada: " . ($result ? 'Éxito' : 'Fallo') . "\n";

    // Delete
    $result = $dao->delete($newCategoria->getIdCategoria());
    echo "Categoría eliminada: " . ($result ? 'Éxito' : 'Fallo') . "\n";
}

// Ejecutar pruebas
echo "Pruebas para UsuarioDAO:\n";
testUsuarioDAO();

echo "\nPruebas para AutorDAO:\n";
testAutorDAO();

echo "\nPruebas para EditorialDAO:\n";
testEditorialDAO();

echo "\nPruebas para CategoriaDAO:\n";
testCategoriaDAO();
?>
