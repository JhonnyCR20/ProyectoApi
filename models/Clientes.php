
<?php

class Clientes{
    public $id ;    
    public $nombre ;
    public $apellidos ;
    public $telefono ;

    public function __construct($id, $nombre, $apellidos, $telefono){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
    }

}



?>