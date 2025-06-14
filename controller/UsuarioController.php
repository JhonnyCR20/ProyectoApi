<?php
require_once __DIR__ . '/../accessoDatos/UsuarioDAO.php';

class UsuarioController {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function listar() {
        return $this->usuarioDAO->obtenerTodos();
    }

    public function obtener($id) {
        return $this->usuarioDAO->obtenerPorId($id);
    }

    public function crear($datos) {
        // Validaciones básicas
        if (empty($datos['nombre']) || empty($datos['correo']) || empty($datos['clave']) || empty($datos['rol'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        if (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
            return ['error' => 'Correo electrónico no válido'];
        }

        if (!in_array($datos['rol'], ['admin', 'bibliotecario'])) {
            return ['error' => 'Rol no válido'];
        }

        return $this->usuarioDAO->crear($datos);
    }

    public function actualizar($id, $data) {
        if (empty($id) || empty($data['nombre']) || empty($data['correo'])) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        // Convertir el arreglo en un objeto Usuario
        $usuario = [
            'id_usuario' => $id,
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'clave' => isset($data['clave']) ? $data['clave'] : null,
            'rol' => isset($data['rol']) ? $data['rol'] : null
        ];
        return $this->usuarioDAO->actualizar($id, $usuario);
    }

    public function eliminar($id) {
        if (empty($id) || !is_numeric($id)) {
            return ['status' => 'error', 'message' => 'ID inválido o no proporcionado'];
        }

        $usuario = $this->usuarioDAO->obtenerPorId($id);
        if (!$usuario) {
            return ['status' => 'error', 'message' => 'Usuario no encontrado'];
        }

        $resultado = $this->usuarioDAO->eliminar($id);
        if ($resultado) {
            return ['status' => 'success', 'message' => 'Usuario eliminado correctamente'];
        }

        return ['status' => 'error', 'message' => 'Error al eliminar el usuario'];
    }

    public function login($correo, $clave) {
        if (empty($correo) || empty($clave)) {
            return ['error' => 'Correo y contraseña son requeridos'];
        }

        $usuario = $this->usuarioDAO->autenticar($correo, $clave);
        if ($usuario) {
            // Aquí podrías iniciar sesión o generar un token JWT
            return ['success' => true, 'usuario' => $usuario];
        }
        return ['error' => 'Credenciales inválidas'];
    }
}
?>
