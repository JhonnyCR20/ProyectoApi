<?php

class Reserva {
    public $id_reserva;
    public $id_lector;
    public $id_libro;
    public $fecha_reserva;
    public $estado;

    public function __construct($id_reserva, $id_lector, $id_libro, $fecha_reserva, $estado) {
        $this->id_reserva = $id_reserva;
        $this->id_lector = $id_lector;
        $this->id_libro = $id_libro;
        $this->fecha_reserva = $fecha_reserva;
        $this->estado = $estado;
    }
}

?>
