<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Salario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Calculadora de Salario</h1>
        <form action="" method="post">
            <label for="horas">Horas trabajadas:</label>
            <input type="number" name="horas" step="0.01" placeholder="Ingrese horas trabajadas" required>
            <br>
            <label for="salario">Salario por hora:</label>
            <input type="number" name="salario" step="0.01" placeholder="Ingrese salario por hora" required>
            <br>
            <button type="submit" name="calcular">Calcular salario</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $horas = $_POST['horas'];
            $salario_por_hora = $_POST['salario'];
            $salario_total = 0;

            if ($horas > 40) {
                $horas_extras = $horas - 40;
                $salario_total = (40 * $salario_por_hora) + ($horas_extras * $salario_por_hora * 1.5);
                echo "<p>Has trabajado más de 40 horas. El salario total con horas extras es: <strong>$" . number_format($salario_total, 2) . "</strong>.</p>";
            } elseif ($horas < 40) {
                $salario_total = $horas * $salario_por_hora;
                $multa = $salario_total * 0.05;
                $salario_total -= $multa;
                echo "<p>Has trabajado menos de 40 horas. El salario total con multa es: <strong>$" . number_format($salario_total, 2) . "</strong>.</p>";
            } else {
                $salario_total = $horas * $salario_por_hora;
                echo "<p>Has trabajado exactamente 40 horas. El salario total es: <strong>$" . number_format($salario_total, 2) . "</strong>.</p>";
            }
        }
        ?>
    </div>

</body>
</html>
