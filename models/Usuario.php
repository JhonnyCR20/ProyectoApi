<?php

class Usuario {
    public $id_usuario;
    public $nombre;
    public $correo;
    public $clave;
    public $rol;

    public function __construct($id_usuario, $nombre, $correo, $clave, $rol) {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->rol = $rol;
    }
}

?>
