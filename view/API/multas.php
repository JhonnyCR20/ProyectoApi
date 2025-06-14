<?php
require_once __DIR__ . '/../../controller/MultaController.php';

$multaController = new MultaController();

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($multaController->obtenerPorId($_GET['id']));
        } else {
            echo json_encode($multaController->obtenerTodos());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($multaController->crear($data));
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $data['id_multa'] = $_GET['id'];
            echo json_encode($multaController->actualizar($data));
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            echo json_encode($multaController->eliminar($_GET['id']));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>
