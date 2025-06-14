<?php
class Libro {
    private $id_libro;
    private $titulo;
    private $anio_publicacion;
    private $id_categoria;
    private $id_editorial;
    private $isbn;
    private $cantidad_disponible;
    private $categoria_nombre;
    private $editorial_nombre;
    private $autores = [];

    // Getters
    public function getId() { return $this->id_libro; }
    public function getTitulo() { return $this->titulo; }
    public function getAnioPublicacion() { return $this->anio_publicacion; }
    public function getIdCategoria() { return $this->id_categoria; }
    public function getIdEditorial() { return $this->id_editorial; }
    public function getIsbn() { return $this->isbn; }
    public function getCantidadDisponible() { return $this->cantidad_disponible; }
    public function getCategoriaNombre() { return $this->categoria_nombre; }
    public function getEditorialNombre() { return $this->editorial_nombre; }
    public function getAutores() { return $this->autores; }

    // Setters
    public function setId($id) { $this->id_libro = $id; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setAnioPublicacion($anio) { $this->anio_publicacion = $anio; }
    public function setIdCategoria($id) { $this->id_categoria = $id; }
    public function setIdEditorial($id) { $this->id_editorial = $id; }
    public function setIsbn($isbn) { $this->isbn = $isbn; }
    public function setCantidadDisponible($cantidad) { $this->cantidad_disponible = $cantidad; }
    public function setCategoriaNombre($nombre) { $this->categoria_nombre = $nombre; }
    public function setEditorialNombre($nombre) { $this->editorial_nombre = $nombre; }
    public function setAutores($autores) { $this->autores = $autores; }

    // Convertir a array para JSON
    public function toArray() {
        return [
            'id_libro' => $this->id_libro,
            'titulo' => $this->titulo,
            'anio_publicacion' => $this->anio_publicacion,
            'id_categoria' => $this->id_categoria,
            'id_editorial' => $this->id_editorial,
            'isbn' => $this->isbn,
            'cantidad_disponible' => $this->cantidad_disponible,
            'categoria_nombre' => $this->categoria_nombre,
            'editorial_nombre' => $this->editorial_nombre,
            'autores' => $this->autores
        ];
    }
}
?>
