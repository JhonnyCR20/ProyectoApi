<?php
require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../models/Reserva.php';

class ReservaDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM grupo6_reservas");
        $reservas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = new Reserva($row['id_reserva'], $row['id_lector'], $row['id_libro'], $row['fecha_reserva'], $row['estado']);
        }
        return $reservas;
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM grupo6_reservas WHERE id_reserva = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null; // Retornar null si no hay resultados
        }

        return new Reserva($row['id_reserva'], $row['id_lector'], $row['id_libro'], $row['fecha_reserva'], $row['estado']);
    }

    public function insert(Reserva $reserva) {
        $stmt = $this->pdo->prepare("INSERT INTO grupo6_reservas (id_lector, id_libro, fecha_reserva, estado) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$reserva->id_lector, $reserva->id_libro, $reserva->fecha_reserva, $reserva->estado]);
    }

    public function update(Reserva $reserva) {
        $stmt = $this->pdo->prepare("UPDATE grupo6_reservas SET id_lector = ?, id_libro = ?, fecha_reserva = ?, estado = ? WHERE id_reserva = ?");
        return $stmt->execute([$reserva->id_lector, $reserva->id_libro, $reserva->fecha_reserva, $reserva->estado, $reserva->id_reserva]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM grupo6_reservas WHERE id_reserva = ?");
        return $stmt->execute([$id]);
    }
}
?>
