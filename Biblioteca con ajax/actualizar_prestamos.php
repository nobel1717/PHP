<?php
require_once 'Biblioteca.php';

$biblioteca = new Biblioteca();

// Mostrar préstamos activos
foreach ($biblioteca->getPrestamosActivos() as $prestamo) {
    echo "<li class=\"list-group-item\">{$prestamo['estudiante']} ha solicitado '{$prestamo['libro']}'</li>";
}

// Si hay un mensaje que mostrar, inclúyelo en el script
if (isset($_GET['mensaje']) && isset($_GET['color'])) {
    $mensaje = $_GET['mensaje'];
    $color = $_GET['color'];

    echo "<script>
        var mensajeDiv = document.getElementById('mensaje');
        mensajeDiv.innerText = '$mensaje';
        mensajeDiv.className = 'alert alert-$color';
        mensajeDiv.style.display = 'block';

        // Ocultar el mensaje después de 3 segundos
        setTimeout(function() {
            mensajeDiv.style.display = 'none';
        }, 3000);
    </script>";
}
?>
