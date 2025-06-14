<?php
require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../models/Autor.php';

class AutorDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM grupo6_autores");
        $autores = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $autores[] = new Autor($row['id_autor'], $row['nombre'], $row['nacionalidad']);
        }
        return $autores;
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM grupo6_autores WHERE id_autor = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Autor($row['id_autor'], $row['nombre'], $row['nacionalidad']);
    }

    public function insert(Autor $autor) {
        $stmt = $this->pdo->prepare("INSERT INTO grupo6_autores (nombre, nacionalidad) VALUES (?, ?)");
        return $stmt->execute([$autor->nombre, $autor->nacionalidad]);
    }

    public function update(Autor $autor) {
        $stmt = $this->pdo->prepare("UPDATE grupo6_autores SET nombre = ?, nacionalidad = ? WHERE id_autor = ?");
        return $stmt->execute([$autor->nombre, $autor->nacionalidad, $autor->id_autor]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM grupo6_autores WHERE id_autor = ?");
        return $stmt->execute([$id]);
    }
}
?>
