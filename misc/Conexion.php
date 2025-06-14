<?php

class Conexion 
{
    public static function conectar(){

        $host = "localhost";
        $db = "grupo6_biblioteca";
        $user = "root";
        $pass = "";
        $charset = "utf8mb4";

        $dns = "mysql:host=$host;dbname=$db;charset=$charset";

        try {

            $pdo = new PDO($dns, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch( PDOException $error ){
            die("Error al conectar: ". $error->getMessage() );

        }
    }
}

?>