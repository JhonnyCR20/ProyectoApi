<?php
require_once __DIR__ . '/../accessoDatos/LectorDAO.php';

class LectorApiController {
    private $lectorDAO;

    public function __construct() {
        $this->lectorDAO = new LectorDAO();
    }

    public function procesarPeticion($metodo, $id = null) {
        header('Content-Type: application/json');
        
        try {
            switch ($metodo) {
                case 'GET':
                    if ($id) {
                        $lector = $this->lectorDAO->getById($id);
                        if ($lector) {
                            echo json_encode(['status' => 'success', 'data' => $lector->toArray()]);
                        } else {
                            http_response_code(404);
                            echo json_encode(['status' => 'error', 'message' => 'Lector no encontrado']);
                        }
                    } else {
                        $lectores = $this->lectorDAO->getAll();
                        echo json_encode(['status' => 'success', 'data' => array_map(function($lector) {
                            return $lector->toArray();
                        }, $lectores)]);
                    }
                    break;

                case 'POST':
                    $datos = json_decode(file_get_contents('php://input'), true);
                    $lector = new Lector();
                    $lector->setNombre($datos['nombre']);
                    $lector->setCorreo($datos['correo']);
                    $lector->setTelefono($datos['telefono']);
                    $lector->setDireccion($datos['direccion']);
                    
                    $id = $this->lectorDAO->create($lector);
                    http_response_code(201);
                    echo json_encode(['status' => 'success', 'message' => 'Lector creado', 'id' => $id]);
                    break;

                case 'PUT':
                    if (!$id) {
                        http_response_code(400);
                        echo json_encode(['status' => 'error', 'message' => 'Se requiere ID']);
                        break;
                    }
                    
                    $datos = json_decode(file_get_contents('php://input'), true);
                    $lector = new Lector();
                    $lector->setId($id);
                    $lector->setNombre($datos['nombre']);
                    $lector->setCorreo($datos['correo']);
                    $lector->setTelefono($datos['telefono']);
                    $lector->setDireccion($datos['direccion']);
                    
                    if ($this->lectorDAO->update($lector)) {
                        echo json_encode(['status' => 'success', 'message' => 'Lector actualizado']);
                    } else {
                        http_response_code(404);
                        echo json_encode(['status' => 'error', 'message' => 'Lector no encontrado']);
                    }
                    break;

                case 'DELETE':
                    if (!$id) {
                        http_response_code(400);
                        echo json_encode(['status' => 'error', 'message' => 'Se requiere ID']);
                        break;
                    }
                    
                    if ($this->lectorDAO->delete($id)) {
                        echo json_encode(['status' => 'success', 'message' => 'Lector eliminado']);
                    } else {
                        http_response_code(404);
                        echo json_encode(['status' => 'error', 'message' => 'Lector no encontrado']);
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
    }
}
?>
