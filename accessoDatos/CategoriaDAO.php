<?php
require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../models/Categoria.php';

class CategoriaDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM grupo6_categorias");
        $categorias = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categorias[] = new Categoria($row['id_categoria'], $row['nombre'], $row['descripcion']);
        }
        return $categorias;
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM grupo6_categorias WHERE id_categoria = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Categoria($row['id_categoria'], $row['nombre'], $row['descripcion']);
    }

    public function insert(Categoria $categoria) {
        $stmt = $this->pdo->prepare("INSERT INTO grupo6_categorias (nombre, descripcion) VALUES (?, ?)");
        return $stmt->execute([$categoria->nombre, $categoria->descripcion]);
    }

    public function update(Categoria $categoria) {
        $stmt = $this->pdo->prepare("UPDATE grupo6_categorias SET nombre = ?, descripcion = ? WHERE id_categoria = ?");
        return $stmt->execute([$categoria->nombre, $categoria->descripcion, $categoria->id_categoria]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM grupo6_categorias WHERE id_categoria = ?");
        return $stmt->execute([$id]);
    }
}
?>
