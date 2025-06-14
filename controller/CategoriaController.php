<?php
require_once __DIR__ . '/../accessoDatos/CategoriaDAO.php';

class CategoriaController {
    private $categoriaDAO;

    public function __construct() {
        $this->categoriaDAO = new CategoriaDAO();
    }

    public function obtenerTodos() {
        return $this->categoriaDAO->getAll();
    }

    public function obtenerPorId($id) {
        return $this->categoriaDAO->getById($id);
    }

    public function crear($data) {
        if (empty($data['nombre']) || empty($data['descripcion'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Categoria
        $categoria = new Categoria(null, $data['nombre'], $data['descripcion']);
        return $this->categoriaDAO->insert($categoria);
    }

    public function actualizar($data) {
        if (empty($data['id_categoria']) || empty($data['nombre']) || empty($data['descripcion'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Categoria
        $categoria = new Categoria($data['id_categoria'], $data['nombre'], $data['descripcion']);
        return $this->categoriaDAO->update($categoria);
    }

    public function eliminar($id) {
        return $this->categoriaDAO->delete($id);
    }
}
?>
