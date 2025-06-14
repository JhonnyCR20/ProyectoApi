<?php
require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../models/DetallePrestamo.php';

class DetallePrestamoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM grupo6_detalle_prestamo");
        $detalles = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $detalles[] = new DetallePrestamo($row['id_detalle'], $row['id_prestamo'], $row['id_libro'], $row['cantidad']);
        }
        return $detalles;
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM grupo6_detalle_prestamo WHERE id_detalle = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new DetallePrestamo($row['id_detalle'], $row['id_prestamo'], $row['id_libro'], $row['cantidad']);
    }

    public function insert(DetallePrestamo $detalle) {
        $stmt = $this->pdo->prepare("INSERT INTO grupo6_detalle_prestamo (id_prestamo, id_libro, cantidad) VALUES (?, ?, ?)");
        return $stmt->execute([$detalle->id_prestamo, $detalle->id_libro, $detalle->cantidad]);
    }

    public function update(DetallePrestamo $detalle) {
        $stmt = $this->pdo->prepare("UPDATE grupo6_detalle_prestamo SET id_prestamo = ?, id_libro = ?, cantidad = ? WHERE id_detalle = ?");
        return $stmt->execute([$detalle->id_prestamo, $detalle->id_libro, $detalle->cantidad, $detalle->id_detalle]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM grupo6_detalle_prestamo WHERE id_detalle = ?");
        return $stmt->execute([$id]);
    }
}
?>
