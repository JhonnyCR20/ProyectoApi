<?php
require_once __DIR__ . '/../models/Categoria.php';

class CategoriaTest {
    public function testCategoriaCreation() {
        $categoria = new Categoria(1, 'Ficción', 'Libros de ficción');
        assert($categoria->id_categoria === 1);
        assert($categoria->nombre === 'Ficción');
        assert($categoria->descripcion === 'Libros de ficción');
        echo "CategoriaTest passed.\n";
    }
}

$test = new CategoriaTest();
$test->testCategoriaCreation();
?>
