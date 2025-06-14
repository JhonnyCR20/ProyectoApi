<?php

require_once __DIR__.'/../accessoDatos/ClientesDAO.php';


class ClientesApiController{


    private $dao;

    public function __construct(){
        $this->dao = new ClientesDAO();
    }


    
    public function manejarRequest(){
        $metodo = $_SERVER['REQUEST_METHOD'];

        //POST, GET, PUT DELETE
        switch ($metodo) {
            case 'GET':
                # code...
                    $response = $this->dao->obtenerDatos();
                    echo json_encode($response);
                break;

            case 'POST':
                # code...
                    $datos = json_decode(file_get_contents("php://input"), true);

                                    
                    $nombre = $datos['nombre'];
                    $apellidos = $datos['apellidos'];
                    $telefono = $datos['telefono'];

                    $objeto = new Clientes(null, $nombre, $apellidos, $telefono);

                    $this->dao->insertar($objeto);


                    echo json_encode(["mensaje" => "Datos almacenados"]);

                break;
            
                
            // case 'PUT':
            //     # code...
            //     break;
            
                
            // case 'DELETE':
            //     # code...
            //     break;
                            

            // default:
            //     # code...
            //     break;
        }
    }


    // public function obtenerDatos(){
    //     return $this->dao->obtenerDatos();
    // }


    // public function obtenerPorId($id){
    //     return $this->dao->obtenerPorId($id);
    // }


    // public function insertar(Clientes $objeto){
    //     return $this->dao->insertar($objeto);
    // }

}



// if ( $_SERVER['REQUEST_METHOD'] == 'POST'){


//     $nombre = $_POST['nombre'];
//     $apellidos = $_POST['apellidos'];
//     $telefono = $_POST['telefono'];

//     $objeto = new Clientes(null, $nombre, $apellidos, $telefono);

//     $controlador = new ClientesController();
//     $controlador->insertar($objeto);

//     header("Location: ../view/Clientes");
//     exit();
// //    ??? insertar
// //necesito capturar las variables del post, lo que viene del formulario
// //crear el objeto
// //luego enviar el objeto 
// //acceder a insertar


// //     echo "Guardando";
// // }

// // else {
// //     echo "usted no esta autorizado";
// }



?>