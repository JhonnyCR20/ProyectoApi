<?php

class Multa {
    public $id_multa;
    public $id_prestamo;
    public $monto;
    public $pagado;

    public function __construct($id_multa, $id_prestamo, $monto, $pagado) {
        $this->id_multa = $id_multa;
        $this->id_prestamo = $id_prestamo;
        $this->monto = $monto;
        $this->pagado = $pagado;
    }
}

?>
