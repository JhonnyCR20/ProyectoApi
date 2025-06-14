<?php
require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../models/Historial.php';

class HistorialDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM grupo6_historial");
        $historiales = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $historiales[] = new Historial($row['id_historial'], $row['id_lector'], $row['accion'], $row['fecha']);
        }
        return $historiales;
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Grupo6_historial WHERE id_historial = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Historial($row['id_historial'], $row['id_lector'], $row['accion'], $row['fecha']);
    }

    public function insert(Historial $historial) {
        $stmt = $this->pdo->prepare("INSERT INTO Grupo6_historial (id_lector, accion, fecha) VALUES (?, ?, ?)");
        return $stmt->execute([$historial->id_lector, $historial->accion, $historial->fecha]);
    }

    public function update(Historial $historial) {
        $stmt = $this->pdo->prepare("UPDATE Grupo6_historial SET id_lector = ?, accion = ?, fecha = ? WHERE id_historial = ?");
        return $stmt->execute([$historial->id_lector, $historial->accion, $historial->fecha, $historial->id_historial]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Grupo6_historial WHERE id_historial = ?");
        return $stmt->execute([$id]);
    }
}
?>
