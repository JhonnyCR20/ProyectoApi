<?php
require_once __DIR__ . '/../accessoDatos/DetallePrestamoDAO.php';

class DetallePrestamoController {
    private $detallePrestamoDAO;

    public function __construct() {
        $this->detallePrestamoDAO = new DetallePrestamoDAO();
    }

    public function obtenerTodos() {
        return $this->detallePrestamoDAO->getAll();
    }

    public function obtenerPorId($id) {
        return $this->detallePrestamoDAO->getById($id);
    }

    public function crear($detalle) {
        if (empty($detalle['id_prestamo']) || empty($detalle['id_libro']) || empty($detalle['cantidad'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }
        return $this->detallePrestamoDAO->insert($detalle);
    }

    public function actualizar($detalle) {
        if (empty($detalle['id_detalle']) || empty($detalle['id_prestamo']) || empty($detalle['id_libro']) || empty($detalle['cantidad'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }
        return $this->detallePrestamoDAO->update($detalle);
    }

    public function eliminar($id) {
        return $this->detallePrestamoDAO->delete($id);
    }
}
?>
