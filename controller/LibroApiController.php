<?php
require_once __DIR__ . '/../accessoDatos/LibroDAO.php';

class LibroApiController {
    private $libroDAO;

    public function __construct() {
        $this->libroDAO = new LibroDAO();
    }

    public function procesarPeticion($metodo, $id = null) {
        header('Content-Type: application/json');
        
        try {
            switch ($metodo) {
                case 'GET':
                    if ($id) {
                        $libro = $this->libroDAO->getById($id);
                        if ($libro) {
                            echo json_encode(['status' => 'success', 'data' => $libro->toArray()]);
                        } else {
                            http_response_code(404);
                            echo json_encode(['status' => 'error', 'message' => 'Libro no encontrado']);
                        }
                    } else {
                        $libros = $this->libroDAO->getAll();
                        echo json_encode(['status' => 'success', 'data' => array_map(function($libro) {
                            return $libro->toArray();
                        }, $libros)]);
                    }
                    break;

                case 'POST':
                    $datos = json_decode(file_get_contents('php://input'), true);
                    $libro = new Libro();
                    $libro->setTitulo($datos['titulo']);
                    $libro->setAnioPublicacion($datos['anio_publicacion']);
                    $libro->setIdCategoria($datos['id_categoria']);
                    $libro->setIdEditorial($datos['id_editorial']);
                    $libro->setIsbn($datos['isbn']);
                    $libro->setCantidadDisponible($datos['cantidad_disponible']);
                    if (isset($datos['autores'])) {
                        $libro->setAutores($datos['autores']);
                    }
                    
                    $id = $this->libroDAO->create($libro);
                    http_response_code(201);
                    echo json_encode(['status' => 'success', 'message' => 'Libro creado', 'id' => $id]);
                    break;

                case 'PUT':
                    if (!$id) {
                        http_response_code(400);
                        echo json_encode(['status' => 'error', 'message' => 'Se requiere ID']);
                        break;
                    }
                    
                    $datos = json_decode(file_get_contents('php://input'), true);
                    $libro = new Libro();
                    $libro->setId($id);
                    $libro->setTitulo($datos['titulo']);
                    $libro->setAnioPublicacion($datos['anio_publicacion']);
                    $libro->setIdCategoria($datos['id_categoria']);
                    $libro->setIdEditorial($datos['id_editorial']);
                    $libro->setIsbn($datos['isbn']);
                    $libro->setCantidadDisponible($datos['cantidad_disponible']);
                    if (isset($datos['autores'])) {
                        $libro->setAutores($datos['autores']);
                    }
                    
                    if ($this->libroDAO->update($libro)) {
                        echo json_encode(['status' => 'success', 'message' => 'Libro actualizado']);
                    } else {
                        http_response_code(404);
                        echo json_encode(['status' => 'error', 'message' => 'Libro no encontrado']);
                    }
                    break;

                case 'DELETE':
                    if (!$id) {
                        http_response_code(400);
                        echo json_encode(['status' => 'error', 'message' => 'Se requiere ID']);
                        break;
                    }
                    
                    if ($this->libroDAO->delete($id)) {
                        echo json_encode(['status' => 'success', 'message' => 'Libro eliminado']);
                    } else {
                        http_response_code(404);
                        echo json_encode(['status' => 'error', 'message' => 'Libro no encontrado']);
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
