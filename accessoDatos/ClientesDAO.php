<?php

require_once __DIR__.'/../misc/Conexion.php';
require_once __DIR__.'/../models/Clientes.php';



class ClientesDAO{

    private $pdo;

    public function __construct(){
        $this->pdo = Conexion::conectar();
    }


    public function obtenerDatos(){
        $stmt = $this->pdo->query("Select * from clientes");

        $result = [];

        while ($row = $stmt->fetch((PDO::FETCH_ASSOC))){
            $result[] = new Clientes($row['id'], $row['nombre'], $row['apellidos'], $row['telefono']);
        }

        return $result;

    }

    public function obtenerPorId($id){
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.clientes WHERE id = ?;");
        $stmt->execute([$id]);
        
        $row = $stmt->fetch((PDO::FETCH_ASSOC));
        return new Clientes($row['id'], $row['nombre'], $row['apellidos'], $row['telefono']);
        
    }

    public function insertar( Clientes $objeto){
        $sql = "INSERT INTO u484426513_ms225.clientes(nombre, apellidos, telefono) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$objeto->nombre, $objeto->apellidos, $objeto->telefono]);
    }


}


?>