<?php

class Prestamo {
    public $id_prestamo;
    public $id_lector;
    public $fecha_prestamo;
    public $fecha_devolucion;
    public $estado;

    public function __construct($id_prestamo, $id_lector, $fecha_prestamo, $fecha_devolucion, $estado) {
        $this->id_prestamo = $id_prestamo;
        $this->id_lector = $id_lector;
        $this->fecha_prestamo = $fecha_prestamo;
        $this->fecha_devolucion = $fecha_devolucion;
        $this->estado = $estado;
    }
}

?>
