<?php
require 'clases.php';

session_start();

$libros = [
    new Libro("MAT101", "Matemáticas 3", "3ª Edición", "Editorial Santillana", "Juan Pérez", 5),
    new Libro("FIS102", "Termodinámica", "1ª Edición", "Editorial McGraw-Hill", "Carlos Gómez", 3),
    new Libro("QUI103", "Química Orgánica", "2ª Edición", "Editorial Pearson", "Luis Martínez", 4),
    new Libro("BIO104", "Física Mecánica", "5ª Edición", "Editorial SM", "Ana Rodríguez", 6),
    new Libro("HIS105", "Historia De Panamá", "4ª Edición", "Editorial Norma", "Pedro Ramírez", 2),
];

if (!isset($_SESSION['prestamos'])) {
    $_SESSION['prestamos'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreEstudiante = $_POST['nombre'];
    $codigoLibro = $_POST['libro'];
    $accion = $_POST['accion'];

    foreach ($libros as $libro) {
        if ($libro->codigo === $codigoLibro) {
            if ($accion === 'solicitar') {
                $prestamoExistente = array_filter($_SESSION['prestamos'], function ($prestamo) use ($nombreEstudiante, $libro) {
                    return $prestamo->estudiante === $nombreEstudiante && $prestamo->libro === $libro->titulo;
                });

                if (count($prestamoExistente) > 0) {
                    $mensaje = "El estudiante '$nombreEstudiante' ya tiene el libro '{$libro->titulo}'.";
                    $color = "warning";
                } elseif ($libro->cantidad > 0) {
                    $libro->cantidad--;
                    $_SESSION['prestamos'][] = new Prestamo($nombreEstudiante, $libro->titulo);
                    $mensaje = "Préstamo aprobado para el libro: '{$libro->titulo}'";
                    $color = "success";
                } else {
                    $mensaje = "No hay libros disponibles para el préstamo.";
                    $color = "danger";
                }
            } elseif ($accion === 'devolver') {
                // Devolver el libro
                $key = array_search(new Prestamo($nombreEstudiante, $libro->titulo), $_SESSION['prestamos']);
                if ($key !== false) {
                    $libro->cantidad++;
                    unset($_SESSION['prestamos'][$key]);
                    $mensaje = "El libro '{$libro->titulo}' ha sido devuelto con éxito.";
                    $color = "success";
                } else {
                    $mensaje = "No se encontró un préstamo para '{$libro->titulo}' por el estudiante '$nombreEstudiante'.";
                    $color = "danger";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca UTP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Préstamos de Libros UTP</h1>

        <?php if (isset($mensaje)): ?>
            <div class="alert alert-<?php echo $color; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del Estudiante</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="libro">Selecciona un Libro</label>
                <select class="form-control" id="libro" name="libro" required>
                    <option value="">Selecciona un libro</option>
                    <?php foreach ($libros as $libro): ?>
                        <?php if ($libro->cantidad > 0): ?>
                            <option value="<?php echo $libro->codigo; ?>">
                                <?php echo "{$libro->titulo} - {$libro->version} (Editorial: {$libro->editorial}, Autor: {$libro->autor}, Disponibles: {$libro->cantidad})"; ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Acción</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="accion" id="solicitar" value="solicitar" required>
                    <label class="form-check-label" for="solicitar">Solicitar</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="accion" id="devolver" value="devolver" required>
                    <label class="form-check-label" for="devolver">Devolver</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Procesar</button>
        </form>

        <h2 class="mt-5">Préstamos Activos</h2>
        <ul class="list-group">
            <?php if (!empty($_SESSION['prestamos'])): ?>
                <?php foreach ($_SESSION['prestamos'] as $prestamo): ?>
                    <li class="list-group-item"><?php echo "{$prestamo->estudiante} ha solicitado '{$prestamo->libro}'"; ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No hay préstamos activos.</li>
            <?php endif; ?>
        </ul>

        <h2 class="mt-5">Libros Disponibles</h2>
        <ul class="list-group">
            <?php foreach ($libros as $libro): ?>
                <li class="list-group-item"><?php echo "{$libro->titulo} - {$libro->version} (Editorial: {$libro->editorial}, Autor: {$libro->autor}, Disponibles: {$libro->cantidad})"; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
