<?php
require 'db_connection.php';

// Verificar si se envió el código del patrón
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    try {
        // Preparar la consulta para buscar el patrón
        $sql = "SELECT * FROM conductor_patron WHERE codigo = :codigo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':codigo' => $codigo]);

        // Obtener resultados
        $patron = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($patron) {
            // Mostrar los datos del patrón
            echo "<div style='margin: 20px; font-family: Arial;'>
                    <h2>Datos del Patrón</h2>
                    <p><strong>Código:</strong> {$patron['codigo']}</p>
                    <p><strong>Nombre:</strong> {$patron['nombre']}</p>
                    <p><strong>Teléfono:</strong> {$patron['telefono']}</p>
                    <p><strong>Dirección:</strong> {$patron['direccion']}</p>
                    <a href='registrar_patron.php' class='btn btn-primary'>Volver</a>
                  </div>";
        } else {
            // No se encontró el patrón
            echo "<script>
                    alert('No se encontró un patrón con el código proporcionado.');
                    window.location.href = 'registrar_patron.php';
                  </script>";
        }
    } catch (PDOException $e) {
        // Manejo de errores
        echo "<script>
                alert('Error al buscar el patrón: " . $e->getMessage() . "');
                window.location.href = 'registrar_patron.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Código no proporcionado.');
            window.location.href = 'registrar_patron.php';
          </script>";
}
?>
