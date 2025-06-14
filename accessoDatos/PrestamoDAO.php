<?php
require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../models/Prestamo.php';

class PrestamoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM grupo6_prestamos");
        $prestamos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $prestamos[] = new Prestamo($row['id_prestamo'], $row['id_lector'], $row['fecha_prestamo'], $row['fecha_devolucion'], $row['estado']);
        }
        return $prestamos;
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM grupo6_prestamos WHERE id_prestamo = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Prestamo($row['id_prestamo'], $row['id_lector'], $row['fecha_prestamo'], $row['fecha_devolucion'], $row['estado']);
    }

    public function insert(Prestamo $prestamo) {
        $stmt = $this->pdo->prepare("INSERT INTO grupo6_prestamos (id_lector, fecha_prestamo, fecha_devolucion, estado) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$prestamo->id_lector, $prestamo->fecha_prestamo, $prestamo->fecha_devolucion, $prestamo->estado]);
    }

    public function update(Prestamo $prestamo) {
        $stmt = $this->pdo->prepare("UPDATE grupo6_prestamos SET id_lector = ?, fecha_prestamo = ?, fecha_devolucion = ?, estado = ? WHERE id_prestamo = ?");
        return $stmt->execute([$prestamo->id_lector, $prestamo->fecha_prestamo, $prestamo->fecha_devolucion, $prestamo->estado, $prestamo->id_prestamo]);
    }

    public function delete($id) {
        try {
            // Eliminar registros relacionados en detalle_prestamo
            $sqlDetalle = "DELETE FROM grupo6_detalle_prestamo WHERE id_prestamo = :id";
            $stmtDetalle = $this->pdo->prepare($sqlDetalle);
            $stmtDetalle->bindParam(':id', $id);
            $stmtDetalle->execute();

            // Eliminar el préstamo
            $sql = "DELETE FROM grupo6_prestamos WHERE id_prestamo = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error al eliminar préstamo: " . $e->getMessage();
            return false;
        }
    }
}
?>
