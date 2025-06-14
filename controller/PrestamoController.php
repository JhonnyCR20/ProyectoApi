<?php
require_once __DIR__ . '/../accessoDatos/PrestamoDAO.php';

class PrestamoController {
    private $prestamoDAO;

    public function __construct() {
        $this->prestamoDAO = new PrestamoDAO();
    }

    public function obtenerTodos() {
        return $this->prestamoDAO->getAll();
    }

    public function obtenerPorId($id) {
        return $this->prestamoDAO->getById($id);
    }

    public function crear($data) {
        if (empty($data['id_lector']) || empty($data['fecha_prestamo']) || empty($data['fecha_devolucion']) || empty($data['estado'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Prestamo
        $prestamo = new Prestamo(null, $data['id_lector'], $data['fecha_prestamo'], $data['fecha_devolucion'], $data['estado']);
        return $this->prestamoDAO->insert($prestamo);
    }

    public function actualizar($data) {
        if (empty($data['id_prestamo']) || empty($data['id_lector']) || empty($data['fecha_prestamo']) || empty($data['fecha_devolucion']) || empty($data['estado'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Prestamo
        $prestamo = new Prestamo($data['id_prestamo'], $data['id_lector'], $data['fecha_prestamo'], $data['fecha_devolucion'], $data['estado']);
        return $this->prestamoDAO->update($prestamo);
    }

    public function eliminar($id) {
        return $this->prestamoDAO->delete($id);
    }
}
?>
