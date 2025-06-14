<?php
class Lector {
    private $id_lector;
    private $nombre;
    private $correo;
    private $telefono;
    private $direccion;

    // Getters
    public function getId() { return $this->id_lector; }
    public function getNombre() { return $this->nombre; }
    public function getCorreo() { return $this->correo; }
    public function getTelefono() { return $this->telefono; }
    public function getDireccion() { return $this->direccion; }

    // Setters
    public function setId($id) { $this->id_lector = $id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setCorreo($correo) { $this->correo = $correo; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }

    // Convertir a array para JSON
    public function toArray() {
        return [
            'id_lector' => $this->id_lector,
            'nombre' => $this->nombre,
            'correo' => $this->correo,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion
        ];
    }
}
?>
