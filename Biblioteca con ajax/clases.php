<?php
class Libro {
    public $codigo;
    public $titulo;
    public $autor;
    public $editorial;
    public $version;
    public $cantidad;

    public function __construct($codigo, $titulo, $autor, $editorial, $version, $cantidad) {
        $this->codigo = $codigo;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->version = $version;
        $this->cantidad = $cantidad;
    }

    public function prestar() {
        if ($this->cantidad > 0) {
            $this->cantidad--;
            return true;
        }
        return false;
    }

    public function devolver() {
        $this->cantidad++;
    }
}

class Biblioteca {
    private $libros = [];

    public function __construct() {
        // Agregando libros a la biblioteca
        $this->libros[] = new Libro("001", "El Principito", "Antoine de Saint-Exupéry", "Reynal & Hitchcock", "1ra", 5);
        $this->libros[] = new Libro("002", "1984", "George Orwell", "Secker & Warburg", "1ra", 2);
        $this->libros[] = new Libro("003", "Cien Años de Soledad", "Gabriel García Márquez", "Editorial Sudamericana", "1ra", 3);
        // Agregar más libros
        $this->libros[] = new Libro("004", "Don Quijote de la Mancha", "Miguel de Cervantes", "Francisco de Robles", "1ra", 4);
        $this->libros[] = new Libro("005", "Matar a un Ruiseñor", "Harper Lee", "J. B. Lippincott & Co.", "1ra", 6);
        $this->libros[] = new Libro("006", "Crimen y Castigo", "Fiódor Dostoyevski", "The Russian Messenger", "1ra", 3);
        $this->libros[] = new Libro("007", "La Metamorfosis", "Franz Kafka", "Kurt Wolff", "1ra", 2);
        $this->libros[] = new Libro("008", "Orgullo y Prejuicio", "Jane Austen", "T. Egerton", "1ra", 4);
        $this->libros[] = new Libro("009", "Los Miserables", "Victor Hugo", "A. Lacroix & Co.", "1ra", 5);
        $this->libros[] = new Libro("010", "Ulises", "James Joyce", "Sylvia Beach", "1ra", 3);
    }

    public function obtenerLibros() {
        return $this->libros;
    }

    public function buscarLibroPorCodigo($codigo) {
        foreach ($this->libros as $libro) {
            if ($libro->codigo === $codigo) {
                return $libro;
            }
        }
        return null;
    }
}

// Creación de la biblioteca
$biblioteca = new Biblioteca();
$libros = $biblioteca->obtenerLibros();

// Enviar los libros como JSON para ser consumidos en el frontend
header('Content-Type: application/json');
echo json_encode($libros);
?>
