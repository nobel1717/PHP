<?php
require 'db_connection.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $matricula = $_POST['matricula'];
    $codigo_patron = $_POST['codigo_patron'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $destino = $_POST['destino'];

    try {
        // Verificar si el código de patrón existe en la tabla Conductor_Patron
        $sql_check_patron = "SELECT * FROM Conductor_Patron WHERE codigo = :codigo_patron";
        $stmt_check_patron = $pdo->prepare($sql_check_patron);
        $stmt_check_patron->execute([':codigo_patron' => $codigo_patron]);
        
        if ($stmt_check_patron->rowCount() == 0) {
            echo "<script>
                    alert('Código de patrón no encontrado.');
                    window.location.href = 'registrar_viaje.php';
                  </script>";
            exit();
        }

        // Preparar la consulta para insertar el viaje
        $sql = "INSERT INTO viaje (matribarco, codpatron, fecha, hora, destino)
                VALUES (:matricula, :codigo_patron, :fecha, :hora, :destino)";
        $stmt = $pdo->prepare($sql);

        // Ejecutar la consulta con los valores del formulario
        $stmt->execute([
            ':matricula' => $matricula,
            ':codigo_patron' => $codigo_patron,
            ':fecha' => $fecha,
            ':hora' => $hora,
            ':destino' => $destino
        ]);

        // Confirmar éxito
        echo "<script>
                alert('Viaje registrado exitosamente.');
                window.location.href = 'registrar_viaje.php';
              </script>";
    } catch (PDOException $e) {
        // Manejo de errores
        echo "<script>
                alert('Error al registrar el viaje: " . $e->getMessage() . "');
                window.location.href = 'registrar_viaje.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Método no permitido.');
            window.location.href = 'registrar_viaje.php';
          </script>";
}
?>
