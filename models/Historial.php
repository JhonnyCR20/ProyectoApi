<?php

class Historial {
    public $id_historial;
    public $id_lector;
    public $accion;
    public $fecha;

    public function __construct($id_historial, $id_lector, $accion, $fecha) {
        $this->id_historial = $id_historial;
        $this->id_lector = $id_lector;
        $this->accion = $accion;
        $this->fecha = $fecha;
    }
}

?>
