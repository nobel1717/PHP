<?php
require 'db_connection.php';

$viajes = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la matrícula del barco
    $matricula_barco = $_POST['matricula_barco'];

    // Consultar los viajes registrados para esa matrícula
    $sql = "SELECT v.numero, v.matribarco, v.codpatron, v.fecha, v.hora, v.destino, p.nombre 
            FROM viaje v
            INNER JOIN Conductor_Patron p ON v.codpatron = p.codigo
            WHERE v.matribarco = :matricula_barco";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':matricula_barco' => $matricula_barco]);

    $viajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Viajes</title>
    <!-- Agregar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Club Náutico</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="registrar_patron.php">Registrar/Búsqueda de Patrones</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="registrar_viaje.php">Registrar Viaje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="informe_viajes">Informe de Viaje</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h3>Informe de Viajes por Barco</h3>
        <form method="POST" action="" class="mb-3">
            <div class="mb-3">
                <label for="matricula_barco" class="form-label">Matrícula del Barco:</label>
                <input type="text" name="matricula_barco" id="matricula_barco" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar Viajes</button>
        </form>

        <?php if (!empty($viajes)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Matrícula</th>
                        <th>Código del Patrón</th>
                        <th>Nombre del Patrón</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Destino</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($viajes as $viaje): ?>
                        <tr>
                            <td><?php echo $viaje['numero']; ?></td>
                            <td><?php echo $viaje['matribarco']; ?></td>
                            <td><?php echo $viaje['codpatron']; ?></td>
                            <td><?php echo $viaje['nombre']; ?></td>
                            <td><?php echo $viaje['fecha']; ?></td>
                            <td><?php echo $viaje['hora']; ?></td>
                            <td><?php echo $viaje['destino']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <p>No se encontraron viajes para la matrícula del barco proporcionada.</p>
        <?php endif; ?>
    </div>

    <!-- Agregar Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
