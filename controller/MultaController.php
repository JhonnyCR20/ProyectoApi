<?php
require_once __DIR__ . '/../accessoDatos/MultaDAO.php';

class MultaController {
    private $multaDAO;

    public function __construct() {
        $this->multaDAO = new MultaDAO();
    }

    public function obtenerTodos() {
        return $this->multaDAO->getAll();
    }

    public function obtenerPorId($id) {
        return $this->multaDAO->getById($id);
    }

    public function crear($data) {
        if (empty($data['id_prestamo']) || empty($data['monto']) || !isset($data['pagado'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Multa
        $multa = new Multa(null, $data['id_prestamo'], $data['monto'], $data['pagado']);
        return $this->multaDAO->insert($multa);
    }

    public function actualizar($data) {
        if (empty($data['id_multa']) || empty($data['id_prestamo']) || empty($data['monto']) || !isset($data['pagado'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Multa
        $multa = new Multa($data['id_multa'], $data['id_prestamo'], $data['monto'], $data['pagado']);
        return $this->multaDAO->update($multa);
    }

    public function eliminar($id) {
        return $this->multaDAO->delete($id);
    }
}
?>
