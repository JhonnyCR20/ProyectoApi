<?php

class DetallePrestamo {
    public $id_detalle;
    public $id_prestamo;
    public $id_libro;
    public $cantidad;

    public function __construct($id_detalle, $id_prestamo, $id_libro, $cantidad) {
        $this->id_detalle = $id_detalle;
        $this->id_prestamo = $id_prestamo;
        $this->id_libro = $id_libro;
        $this->cantidad = $cantidad;
    }
}

?>
