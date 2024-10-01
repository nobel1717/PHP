<?php
// Verificar si la sesión no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Libro {
    public $codigo;
    public $titulo;
    public $cantidad;

    public function __construct($codigo, $titulo, $cantidad) {
        $this->codigo = $codigo;
        $this->titulo = $titulo;
        $this->cantidad = $cantidad;
    }
}

class Biblioteca {
    public $libros;
    public $prestamosActivos;

    public function __construct() {
        // Inicializar la lista de libros si no está en la sesión
        if (!isset($_SESSION['libros'])) {
            $this->libros = [
                new Libro(1, 'Música', 3),
                new Libro(2, 'Programación para PHP', 2),
                new Libro(3, 'JS códigos', 5),
                new Libro(4, 'Html y sus trucos', 4),
                new Libro(5, '1984', 6),
                new Libro(6, 'Rayuela', 3),
                new Libro(7, 'El Principito', 8),
                new Libro(8, 'Fahrenheit 451', 5)
            ];
            $_SESSION['libros'] = $this->libros;
        } else {
            $this->libros = $_SESSION['libros'];
        }

        // Inicializar los préstamos activos si no está en la sesión
        if (!isset($_SESSION['prestamosActivos'])) {
            $this->prestamosActivos = [];
            $_SESSION['prestamosActivos'] = $this->prestamosActivos;
        } else {
            $this->prestamosActivos = $_SESSION['prestamosActivos'];
        }
    }

    public function getLibros() {
        return $this->libros;
    }

    public function getPrestamosActivos() {
        return $this->prestamosActivos;
    }

    public function procesarPrestamo($nombreEstudiante, $codigoLibro, $accion) {
        // Verificar si el estudiante ya tiene el libro solicitado
        foreach ($this->prestamosActivos as $prestamo) {
            if ($prestamo['estudiante'] == $nombreEstudiante && $prestamo['libroCodigo'] == $codigoLibro && $accion == 'solicitar') {
                return ['mensaje' => 'Ya has solicitado este libro.', 'color' => 'warning'];  // Mensaje amarillo
            }
        }

        // Encontrar el libro
        foreach ($this->libros as &$libro) {
            if ($libro->codigo == $codigoLibro) {
                if ($accion == 'solicitar') {
                    if ($libro->cantidad > 0) {
                        // Reducir la cantidad de libros disponibles
                        $libro->cantidad--;
                        // Registrar el préstamo
                        $this->prestamosActivos[] = ['estudiante' => $nombreEstudiante, 'libro' => $libro->titulo, 'libroCodigo' => $codigoLibro];
                        $_SESSION['libros'] = $this->libros;
                        $_SESSION['prestamosActivos'] = $this->prestamosActivos;
                        return ['mensaje' => 'Préstamo realizado exitosamente.', 'color' => 'success'];  // Mensaje verde
                    } else {
                        return ['mensaje' => 'No hay más copias disponibles de este libro.', 'color' => 'danger'];  // Mensaje rojo
                    }
                } elseif ($accion == 'devolver') {
                    // Aumentar la cantidad de libros disponibles
                    $libro->cantidad++;
                    // Eliminar el préstamo activo
                    foreach ($this->prestamosActivos as $key => $prestamo) {
                        if ($prestamo['estudiante'] == $nombreEstudiante && $prestamo['libro'] == $libro->titulo) {
                            unset($this->prestamosActivos[$key]);
                            $_SESSION['prestamosActivos'] = $this->prestamosActivos;
                            return ['mensaje' => 'Devolución realizada exitosamente.', 'color' => 'success'];  // Mensaje verde
                        }
                    }
                    return ['mensaje' => 'No se encontró un préstamo activo para este libro.', 'color' => 'danger'];  // Mensaje rojo
                }
            }
        }
        return ['mensaje' => 'Libro no encontrado.', 'color' => 'danger'];  // Mensaje rojo
    }
}
?>
