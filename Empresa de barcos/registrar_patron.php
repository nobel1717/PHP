<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Patrones</title>
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
            <a class="nav-link active" href="registrar_patron.php">Registrar/Búsqueda Patrón</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="registrar_viaje.php">Registrar Viaje</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="informe_viajes.php">Informe de Viajes</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <div class="container mt-5">
    <h2 class="text-center">Registrar Patrón</h2>
    <form action="save_patron.php" method="POST" class="mt-4">
        <div class="mb-3">
        <label for="codigo" class="form-label">Código del Patrón</label>
        <input type="text" class="form-control" id="codigo" name="codigo" required>
        </div>
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="mb-3">
        <label for="direccion" class="form-label">Dirección</label>
        <textarea class="form-control" id="direccion" name="direccion" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Registrar Patrón</button>
    </form>

    <h2 class="text-center mt-5">Buscar Patrón</h2>
    <form action="buscar_patron.php" method="GET" class="mt-4">
        <div class="mb-3">
        <label for="codigo_buscar" class="form-label">Código del Patrón</label>
        <input type="text" class="form-control" id="codigo_buscar" name="codigo" required>
        </div>
        <button type="submit" class="btn btn-secondary w-100">Buscar Patrón</button>
    </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
