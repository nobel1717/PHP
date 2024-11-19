<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Viaje</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Club Náutico</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Inicio</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="registrar_patron.php">Registrar/Búsqueda Patrón</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="registrar_viaje.php">Registrar Viaje</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="informe_viajes.php">Informe de Viajes</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Registrar Viaje</h2>
        <form action="save_viaje.php" method="POST" class="mt-4">
            <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula del Barco</label>
            <input type="text" class="form-control" id="matricula" name="matricula" required>
            </div>
            <div class="mb-3">
            <label for="codigo_patron" class="form-label">Código del Patrón</label>
            <input type="text" class="form-control" id="codigo_patron" name="codigo_patron" required>
            </div>
            <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" class="form-control" id="hora" name="hora" required>
            </div>
            <div class="mb-3">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" class="form-control" id="destino" name="destino" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrar Viaje</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
