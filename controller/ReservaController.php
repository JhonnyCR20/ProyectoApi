<?php
require_once __DIR__ . '/../accessoDatos/ReservaDAO.php';

class ReservaController {
    private $reservaDAO;

    public function __construct() {
        $this->reservaDAO = new ReservaDAO();
    }

    public function obtenerTodos() {
        return $this->reservaDAO->getAll();
    }

    public function obtenerPorId($id) {
        return $this->reservaDAO->getById($id);
    }

    public function crear($data) {
        if (empty($data['id_lector']) || empty($data['id_libro']) || empty($data['fecha_reserva']) || empty($data['estado'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Reserva
        $reserva = new Reserva(null, $data['id_lector'], $data['id_libro'], $data['fecha_reserva'], $data['estado']);
        return $this->reservaDAO->insert($reserva);
    }

    public function actualizar($data) {
        if (empty($data['id_reserva']) || empty($data['id_lector']) || empty($data['id_libro']) || empty($data['fecha_reserva']) || empty($data['estado'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Reserva
        $reserva = new Reserva($data['id_reserva'], $data['id_lector'], $data['id_libro'], $data['fecha_reserva'], $data['estado']);
        return $this->reservaDAO->update($reserva);
    }

    public function eliminar($id) {
        return $this->reservaDAO->delete($id);
    }
}
?>
