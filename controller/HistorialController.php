<?php
require_once __DIR__ . '/../accessoDatos/HistorialDAO.php';

class HistorialController {
    private $historialDAO;

    public function __construct() {
        $this->historialDAO = new HistorialDAO();
    }

    public function obtenerTodos() {
        return $this->historialDAO->getAll();
    }

    public function obtenerPorId($id) {
        return $this->historialDAO->getById($id);
    }

    public function crear($data) {
        if (empty($data['id_lector']) || empty($data['accion']) || empty($data['fecha'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Historial
        $historial = new Historial(null, $data['id_lector'], $data['accion'], $data['fecha']);
        return $this->historialDAO->insert($historial);
    }

    public function actualizar($data) {
        if (empty($data['id_historial']) || empty($data['id_lector']) || empty($data['accion']) || empty($data['fecha'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Historial
        $historial = new Historial($data['id_historial'], $data['id_lector'], $data['accion'], $data['fecha']);
        return $this->historialDAO->update($historial);
    }

    public function eliminar($id) {
        return $this->historialDAO->delete($id);
    }
}
?>
