<?php

    header("Content-Type: application/json");
    require_once '../../controller/ClientesApiController.php';


    $controlador = new ClientesApiController();
    $controlador->manejarRequest();


?>