<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Préstamos de Libros</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Biblioteca del Centro Regional de Azuero</h1>
        <div id="mensaje" class="alert" style="display:none;"></div>
        
        <form id="formulario" method="POST" action="index.php">
            <div class="form-group">
                <label for="nombre">Nombre del Estudiante:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="libro">Seleccionar Libro:</label>
                <select class="form-control" id="libro" name="libro" required>
                    <option value="">Selecciona un libro</option>
                    <?php
                    require_once 'Biblioteca.php';

                    $biblioteca = new Biblioteca();
                    foreach ($biblioteca->getLibros() as $libro) {
                        echo "<option value=\"{$libro->codigo}\">{$libro->titulo} (Disponibles: {$libro->cantidad})</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="accion">Acción:</label>
                <div>
                    <label><input type="radio" name="accion" value="solicitar" checked> Solicitar Préstamo</label>
                    <label><input type="radio" name="accion" value="devolver"> Devolver Libro</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
            <button type="button" id="btn-actualizar" class="btn btn-info">Actualizar</button>
        </form>

        <h2>Préstamos Activos</h2>
        <ul id="prestamos-activos" class="list-group">
            <?php
            // Mostrar préstamos activos
            foreach ($biblioteca->getPrestamosActivos() as $prestamo) {
                echo "<li class=\"list-group-item\">{$prestamo['estudiante']} ha solicitado '{$prestamo['libro']}'</li>";
            }
            ?>
        </ul>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombreEstudiante = $_POST['nombre'];
        $libroCodigo = $_POST['libro'];
        $accion = $_POST['accion'];

        // Procesar la acción de préstamo o devolución
        $resultado = $biblioteca->procesarPrestamo($nombreEstudiante, $libroCodigo, $accion);
        $mensaje = $resultado['mensaje'];
        $color = $resultado['color'];

        echo "<script>
            var mensajeDiv = document.getElementById('mensaje');
            mensajeDiv.innerText = '$mensaje';
            mensajeDiv.className = 'alert alert-$color';
            mensajeDiv.style.display = 'block';
        </script>";
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#btn-actualizar').click(function() {
                $.ajax({
                    url: 'actualizar_prestamos.php',
                    method: 'GET',
                    success: function(data) {
                        $('#prestamos-activos').html(data);
                    },
                    error: function() {
                        alert('Error al actualizar la lista de préstamos.');
                    }
                });
            });
        });
    </script>
</body>
</html>
