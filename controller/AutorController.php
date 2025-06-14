<?php
require_once __DIR__ . '/../accessoDatos/AutorDAO.php';

class AutorController {
    private $autorDAO;

    public function __construct() {
        $this->autorDAO = new AutorDAO();
    }

    public function obtenerTodos() {
        return $this->autorDAO->getAll();
    }

    public function obtenerPorId($id) {
        return $this->autorDAO->getById($id);
    }

    public function crear($data) {
        if (empty($data['nombre']) || empty($data['nacionalidad'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Autor
        $autor = new Autor(null, $data['nombre'], $data['nacionalidad']);
        return $this->autorDAO->insert($autor);
    }

    public function actualizar($data) {
        if (empty($data['id_autor']) || empty($data['nombre']) || empty($data['nacionalidad'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Autor
        $autor = new Autor($data['id_autor'], $data['nombre'], $data['nacionalidad']);
        return $this->autorDAO->update($autor);
    }

    public function eliminar($id) {
        return $this->autorDAO->delete($id);
    }
}
?>
