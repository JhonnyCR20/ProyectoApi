<?php
require_once __DIR__ . '/../accessoDatos/EditorialDAO.php';

class EditorialController {
    private $editorialDAO;

    public function __construct() {
        $this->editorialDAO = new EditorialDAO();
    }

    public function obtenerTodos() {
        return $this->editorialDAO->getAll();
    }

    public function obtenerPorId($id) {
        return $this->editorialDAO->getById($id);
    }

    public function crear($data) {
        if (empty($data['nombre']) || empty($data['pais'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Editorial
        $editorial = new Editorial(null, $data['nombre'], $data['pais']);
        return $this->editorialDAO->insert($editorial);
    }

    public function actualizar($data) {
        if (empty($data['id_editorial']) || empty($data['nombre']) || empty($data['pais'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Editorial
        $editorial = new Editorial($data['id_editorial'], $data['nombre'], $data['pais']);
        return $this->editorialDAO->update($editorial);
    }

    public function eliminar($id) {
        return $this->editorialDAO->delete($id);
    }
}
?>
