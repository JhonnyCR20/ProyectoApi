<?php
require_once __DIR__ . '/../../controller/CategoriaController.php';

$categoriaController = new CategoriaController();

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($categoriaController->obtenerPorId($_GET['id']));
        } else {
            echo json_encode($categoriaController->obtenerTodos());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($categoriaController->crear($data));
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $data['id_categoria'] = $_GET['id'];
            echo json_encode($categoriaController->actualizar($data));
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            echo json_encode($categoriaController->eliminar($_GET['id']));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>
