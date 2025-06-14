<?php
require_once __DIR__ . '/../misc/Conexion.php';

class UsuarioDAO {
    private $conn;
    
    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conectar();
    }

    public function obtenerTodos() {
        try {
            $sql = "SELECT * FROM grupo6_usuarios";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al obtener usuarios: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerPorId($id) {
        try {
            $sql = "SELECT * FROM grupo6_usuarios WHERE id_usuario = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al obtener usuario: " . $e->getMessage();
            return false;
        }
    }

    public function crear($usuario) {
        try {
            $sql = "INSERT INTO grupo6_usuarios (nombre, correo, clave, rol) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $clave_hash = password_hash($usuario['clave'], PASSWORD_DEFAULT);
            $stmt->execute([
                $usuario['nombre'],
                $usuario['correo'],
                $clave_hash,
                $usuario['rol']
            ]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Error al crear usuario: " . $e->getMessage();
            return false;
        }
    }

    public function actualizar($id, $usuario) {
        try {
            $campos = [];
            $valores = [];

            if (isset($usuario['nombre'])) {
                $campos[] = "nombre = ?";
                $valores[] = $usuario['nombre'];
            }
            if (isset($usuario['correo'])) {
                $campos[] = "correo = ?";
                $valores[] = $usuario['correo'];
            }
            if (isset($usuario['clave'])) {
                $campos[] = "clave = ?";
                $valores[] = password_hash($usuario['clave'], PASSWORD_DEFAULT);
            }
            if (isset($usuario['rol'])) {
                $campos[] = "rol = ?";
                $valores[] = $usuario['rol'];
            }

            $valores[] = $id;
            $sql = "UPDATE grupo6_usuarios SET " . implode(", ", $campos) . " WHERE id_usuario = ?";
            
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($valores);
        } catch (Exception $e) {
            echo "Error al actualizar usuario: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $sql = "DELETE FROM grupo6_usuarios WHERE id_usuario = ?";
            $stmt = $this->conn->prepare($sql);
            $resultado = $stmt->execute([$id]);

            if ($resultado) {
                echo "Usuario con ID $id eliminado correctamente.";
            } else {
                echo "No se pudo eliminar el usuario con ID $id.";
            }

            return $resultado;
        } catch (Exception $e) {
            echo "Error al eliminar usuario: " . $e->getMessage();
            return false;
        }
    }

    public function autenticar($correo, $clave) {
        try {
            $sql = "SELECT * FROM grupo6_usuarios WHERE correo = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$correo]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($clave, $usuario['clave'])) {
                unset($usuario['clave']); // No devolver la contraseña
                return $usuario;
            }
            return false;
        } catch (Exception $e) {
            echo "Error en la autenticación: " . $e->getMessage();
            return false;
        }
    }
}
?>
