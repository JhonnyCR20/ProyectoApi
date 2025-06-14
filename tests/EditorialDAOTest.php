<?php
require_once __DIR__ . '/../accessoDatos/EditorialDAO.php';

class EditorialDAOTest {
    private $editorialDAO;

    public function __construct() {
        $this->editorialDAO = new EditorialDAO();
    }

    public function testCRUD() {
        // Crear editorial
        $editorial = new Editorial(null, 'Test Editorial', 'Test Country');
        $id = $this->editorialDAO->insert($editorial);
        assert($id > 0, 'Error al crear editorial');

        // Leer editorial
        $editorialLeido = $this->editorialDAO->getById($id);
        assert($editorialLeido->nombre === 'Test Editorial', 'Error al leer editorial');

        // Actualizar editorial
        $editorial->id_editorial = $id;
        $editorial->nombre = 'Updated Editorial';
        $this->editorialDAO->update($editorial);
        $editorialActualizado = $this->editorialDAO->getById($id);
        assert($editorialActualizado->nombre === 'Updated Editorial', 'Error al actualizar editorial');

        // Eliminar editorial
        $this->editorialDAO->delete($id);
        $editorialEliminado = $this->editorialDAO->getById($id);
        assert($editorialEliminado === null, 'Error al eliminar editorial');

        echo "EditorialDAOTest passed.\n";
    }
}

$test = new EditorialDAOTest();
$test->testCRUD();
?>
