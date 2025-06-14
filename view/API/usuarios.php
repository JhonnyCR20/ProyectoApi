<?php
require_once "../../controller/UsuarioController.php";

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$controller = new UsuarioController();
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode('/', $path);
$id = null;

// Obtener ID si existe en la URL
if (isset($pathParts[count($pathParts)-1]) && is_numeric($pathParts[count($pathParts)-1])) {
    $id = $pathParts[count($pathParts)-1];
}

// Obtener ID desde parámetros de consulta si no está en la URL
if (!$id && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
}

try {
    switch ($method) {
        case 'GET':
            if ($id) {
                $result = $controller->obtener($id);
                if ($result) {
                    echo json_encode(['status' => 'success', 'data' => $result]);
                } else {
                    http_response_code(404);
                    echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
                }
            } else {
                $result = $controller->listar();
                echo json_encode(['status' => 'success', 'data' => $result]);
            }
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            
            // Manejo especial para el endpoint de login
            if (isset($pathParts[count($pathParts)-1]) && $pathParts[count($pathParts)-1] == 'login') {
                $result = $controller->login($data['correo'], $data['clave']);
                if (isset($result['error'])) {
                    http_response_code(401);
                    echo json_encode(['status' => 'error', 'message' => $result['error']]);
                } else {
                    echo json_encode(['status' => 'success', 'data' => $result]);
                }
                break;
            }

            $result = $controller->crear($data);
            if (isset($result['error'])) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => $result['error']]);
            } else {
                http_response_code(201);
                echo json_encode(['status' => 'success', 'message' => 'Usuario creado', 'id' => $result]);
            }
            break;

        case 'PUT':
            if (!$id) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Se requiere ID']);
                break;
            }
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $controller->actualizar($id, $data);
            if (isset($result['error'])) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => $result['error']]);
            } else {
                echo json_encode(['status' => 'success', 'message' => 'Usuario actualizado']);
            }
            break;

        case 'DELETE':
            if (!$id) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Se requiere ID']);
                break;
            }
            if ($controller->eliminar($id)) {
                echo json_encode(['status' => 'success', 'message' => 'Usuario eliminado']);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
