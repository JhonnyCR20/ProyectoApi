<?php
require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../models/Editorial.php';

class EditorialDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM grupo6_editoriales");
        $editoriales = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $editoriales[] = new Editorial($row['id_editorial'], $row['nombre'], $row['pais']);
        }
        return $editoriales;
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM grupo6_editoriales WHERE id_editorial = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Editorial($row['id_editorial'], $row['nombre'], $row['pais']);
    }

    public function insert(Editorial $editorial) {
        $stmt = $this->pdo->prepare("INSERT INTO grupo6_editoriales (nombre, pais) VALUES (?, ?)");
        return $stmt->execute([$editorial->nombre, $editorial->pais]);
    }

    public function update(Editorial $editorial) {
        $stmt = $this->pdo->prepare("UPDATE grupo6_editoriales SET nombre = ?, pais = ? WHERE id_editorial = ?");
        return $stmt->execute([$editorial->nombre, $editorial->pais, $editorial->id_editorial]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM grupo6_editoriales WHERE id_editorial = ?");
        return $stmt->execute([$id]);
    }
}
?>
