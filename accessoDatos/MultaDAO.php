<?php
require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../models/Multa.php';

class MultaDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM grupo6_multas");
        $multas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $multas[] = new Multa($row['id_multa'], $row['id_prestamo'], $row['monto'], $row['pagado']);
        }
        return $multas;
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM grupo6_multas WHERE id_multa = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Multa($row['id_multa'], $row['id_prestamo'], $row['monto'], $row['pagado']);
    }

    public function insert(Multa $multa) {
        $stmt = $this->pdo->prepare("INSERT INTO grupo6_multas (id_prestamo, monto, pagado) VALUES (?, ?, ?)");
        return $stmt->execute([$multa->id_prestamo, $multa->monto, $multa->pagado]);
    }

    public function update(Multa $multa) {
        $stmt = $this->pdo->prepare("UPDATE grupo6_multas SET id_prestamo = ?, monto = ?, pagado = ? WHERE id_multa = ?");
        return $stmt->execute([$multa->id_prestamo, $multa->monto, $multa->pagado, $multa->id_multa]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM grupo6_multas WHERE id_multa = ?");
        return $stmt->execute([$id]);
    }
}
?>
