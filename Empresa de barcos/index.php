<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Náutico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e3f2fd; 
        }
        .navbar {
            background-color: #0d6efd;
        }
        .navbar a {
            color: white !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Club Náutico</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="registrar_patron.php">Registrar/Búsqueda de Patrones</a>
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
        <h1 class="text-center mb-4">Bienvenido al Club Náutico</h1>
        <p class="text-center">El Club Náutico es una comunidad exclusiva que ofrece servicios de gestión de barcos y patrones para garantizar una experiencia de navegación única y placentera. Únete a nosotros y disfruta del mejor servicio.</p>

        <div class="row">
            <div class="col-md-6">
                <img src="Images/barcos.jpg" alt="Foto de barcos" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <img src="Images/barcos2.jpg" alt="Foto del club náutico" class="img-fluid rounded">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
