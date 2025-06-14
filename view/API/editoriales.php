<?php
require_once __DIR__ . '/../../controller/EditorialController.php';

$editorialController = new EditorialController();

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($editorialController->obtenerPorId($_GET['id']));
        } else {
            echo json_encode($editorialController->obtenerTodos());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($editorialController->crear($data));
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $data['id_editorial'] = $_GET['id'];
            echo json_encode($editorialController->actualizar($data));
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            echo json_encode($editorialController->eliminar($_GET['id']));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>
