<?php

class Editorial {
    public $id_editorial;
    public $nombre;
    public $pais;

    public function __construct($id_editorial, $nombre, $pais) {
        $this->id_editorial = $id_editorial;
        $this->nombre = $nombre;
        $this->pais = $pais;
    }

    public function getIdEditorial() {
        return $this->id_editorial;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getPais() {
        return $this->pais;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }
}

?>
