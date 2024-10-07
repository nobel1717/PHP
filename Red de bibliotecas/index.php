<?php
require_once 'Bibliotecas.php';

$redBibliotecas = new RedBibliotecas();
$redBibliotecas->agregarBiblioteca(new Biblioteca("Biblioteca A", 5000, [100, 150, 200]));
$redBibliotecas->agregarBiblioteca(new Biblioteca("Biblioteca B", 3000, [200, 250, 300]));
$redBibliotecas->agregarBiblioteca(new Biblioteca("Biblioteca C", 7000, [120, 130, 110]));
$redBibliotecas->agregarBiblioteca(new Biblioteca("Biblioteca D", 4000, [90, 100, 80]));
$redBibliotecas->agregarBiblioteca(new Biblioteca("Biblioteca E", 6000, [300, 310, 320]));

$totalConsultasBiblioteca = null;
$totalConsultasAño = null;
$promedioConsultas = null;
$matrizBibliotecas = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['biblioteca'])) {
        $nombreBiblioteca = $_POST['biblioteca'];
        $biblioteca = $redBibliotecas->obtenerBibliotecaPorNombre($nombreBiblioteca);
        if ($biblioteca) {
            $totalConsultasBiblioteca = $biblioteca->totalConsultas();
        }
    }

    if (isset($_POST['año'])) {
        $año = (int)$_POST['año'];
        $totalConsultasAño = $redBibliotecas->totalConsultasPorAño($año);
    }

    if (isset($_POST['promedio'])) {
        $promedioConsultas = $redBibliotecas->promedioConsultas();
    }

    if (isset($_POST['imprimir'])) {
        $matrizBibliotecas = $redBibliotecas->imprimirMatriz();
    }

    if (isset($_POST['salir'])) {
        echo "<script>alert('Saliendo de la aplicación');</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red de Bibliotecas Municipales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Red de Bibliotecas Municipales</h1>

        <form method="POST">
            <div class="form-group">
                <label for="biblioteca">Selecciona una biblioteca para ver el total de consultas:</label>
                <select class="form-control" id="biblioteca" name="biblioteca">
                    <option value="">Seleccionar</option>
                    <option value="Biblioteca A">Biblioteca A</option>
                    <option value="Biblioteca B">Biblioteca B</option>
                    <option value="Biblioteca C">Biblioteca C</option>
                    <option value="Biblioteca D">Biblioteca D</option>
                    <option value="Biblioteca E">Biblioteca E</option>
                </select>
            </div>

            <div class="form-group">
                <label for="año">Selecciona un año para ver el total de consultas:</label>
                <select class="form-control" id="año" name="año">
                    <option value="">Seleccionar</option>
                    <option value="0">Año 1</option>
                    <option value="1">Año 2</option>
                    <option value="2">Año 3</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" name="promedio" class="btn btn-info">Calcular Promedio de Consultas</button>
                <button type="submit" name="imprimir" class="btn btn-primary">Imprimir Matriz Completa</button>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Ver Resultados</button>
            </div>

            <div class="form-group">
                <button type="submit" name="salir" class="btn btn-danger">Salir</button>
            </div>
        </form>

        <div class="mt-4">
            <?php
            if ($totalConsultasBiblioteca !== null) {
                echo "<div class='alert alert-success'>Total de consultas de {$nombreBiblioteca}: {$totalConsultasBiblioteca}</div>";
            }

            if ($totalConsultasAño !== null) {
                echo "<div class='alert alert-info'>Total de consultas en el año seleccionado: {$totalConsultasAño}</div>";
            }

            if ($promedioConsultas !== null) {
                echo "<div class='alert alert-warning'>Promedio de consultas en los 3 años: {$promedioConsultas}</div>";
            }

            if ($matrizBibliotecas !== null) {
                echo $matrizBibliotecas;
            }
            ?>
        </div>
    </div>
</body>
</html>
