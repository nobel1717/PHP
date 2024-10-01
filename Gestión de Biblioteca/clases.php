<?php

class Libro {
    public $codigo;
    public $titulo;
    public $version;
    public $editorial;
    public $autor;
    public $cantidad;

    public function __construct($codigo, $titulo, $version, $editorial, $autor, $cantidad) {
        $this->codigo = $codigo;
        $this->titulo = $titulo;
        $this->version = $version;
        $this->editorial = $editorial;
        $this->autor = $autor;
        $this->cantidad = $cantidad;
    }
}

class Prestamo {
    public $estudiante;
    public $libro;

    public function __construct($estudiante, $libro) {
        $this->estudiante = $estudiante;
        $this->libro = $libro;
    }
}
?>
