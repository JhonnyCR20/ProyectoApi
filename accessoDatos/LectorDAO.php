<?php
require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../models/Lector.php';

class LectorDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function getAll() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM grupo6_lectores");
            $lectores = [];
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lector = new Lector();
                $lector->setId($row['id_lector']);
                $lector->setNombre($row['nombre']);
                $lector->setCorreo($row['correo']);
                $lector->setTelefono($row['telefono']);
                $lector->setDireccion($row['direccion']);
                $lectores[] = $lector;
            }
            return $lectores;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener lectores: " . $e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM grupo6_lectores WHERE id_lector = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lector = new Lector();
                $lector->setId($row['id_lector']);
                $lector->setNombre($row['nombre']);
                $lector->setCorreo($row['correo']);
                $lector->setTelefono($row['telefono']);
                $lector->setDireccion($row['direccion']);
                return $lector;
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener lector: " . $e->getMessage());
        }
    }

    public function create($lector) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO grupo6_lectores (nombre, correo, telefono, direccion) 
                 VALUES (:nombre, :correo, :telefono, :direccion)"
            );
            
            $nombre = $lector->getNombre();
            $correo = $lector->getCorreo();
            $telefono = $lector->getTelefono();
            $direccion = $lector->getDireccion();
            
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":correo", $correo);
            $stmt->bindParam(":telefono", $telefono);
            $stmt->bindParam(":direccion", $direccion);
            
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Error al crear lector: " . $e->getMessage());
        }
    }

    public function update($lector) {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE grupo6_lectores 
                 SET nombre = :nombre, correo = :correo, telefono = :telefono, direccion = :direccion 
                 WHERE id_lector = :id"
            );
            
            $id = $lector->getId();
            $nombre = $lector->getNombre();
            $correo = $lector->getCorreo();
            $telefono = $lector->getTelefono();
            $direccion = $lector->getDireccion();
            
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":correo", $correo);
            $stmt->bindParam(":telefono", $telefono);
            $stmt->bindParam(":direccion", $direccion);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar lector: " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM grupo6_lectores WHERE id_lector = :id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar lector: " . $e->getMessage());
        }
    }
}
?>
