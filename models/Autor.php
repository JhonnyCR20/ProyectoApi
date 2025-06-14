<?php

class Autor {
    public $id_autor;
    public $nombre;
    public $nacionalidad;

    public function __construct($id_autor, $nombre, $nacionalidad) {
        $this->id_autor = $id_autor;
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
    }

    public function getIdAutor() {
        return $this->id_autor;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getNacionalidad() {
        return $this->nacionalidad;
    }

    public function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }
}

?>
