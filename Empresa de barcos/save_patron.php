<?php
require 'db_connection.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    try {
        // Verificar si el código de patrón ya existe
        $sql_check_codigo = "SELECT * FROM Conductor_Patron WHERE codigo = :codigo";
        $stmt_check_codigo = $pdo->prepare($sql_check_codigo);
        $stmt_check_codigo->execute([':codigo' => $codigo]);

        if ($stmt_check_codigo->rowCount() > 0) {
            // Validación del código
            echo "<script>
                    alert('El código de patrón ya está en uso. Por favor, elija otro.');
                    window.location.href = 'registrar_patron.php';
                  </script>";
            exit();
        }

        // Preparar la consulta para insertar el patrón
        $sql = "INSERT INTO Conductor_Patron (codigo, nombre, telefono, direccion)
                VALUES (:codigo, :nombre, :telefono, :direccion)";
        $stmt = $pdo->prepare($sql);

        // Ejecutar la consulta con los valores del formulario
        $stmt->execute([
            ':codigo' => $codigo,
            ':nombre' => $nombre,
            ':telefono' => $telefono,
            ':direccion' => $direccion
        ]);

        // Confirmar éxito
        echo "<script>
                alert('Patrón registrado exitosamente.');
                window.location.href = 'registrar_patron.php';
              </script>";
    } catch (PDOException $e) {
        // Manejo de errores
        echo "<script>
                alert('Error al registrar el patrón: " . $e->getMessage() . "');
                window.location.href = 'registrar_patron.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Método no permitido.');
            window.location.href = 'registrar_patron.php';
          </script>";
}
?>
