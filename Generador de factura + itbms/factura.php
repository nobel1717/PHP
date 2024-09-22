<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Generada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container mt-5">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $articulos = $_POST['articulo'];
        $cantidades = $_POST['cantidad'];
        $precios = $_POST['precio'];

        $subtotal = 0;
        $itbms = 0;
        $total = 0;

        echo '<h2 class="text-center">Factura Generada</h2>';
        echo '<table class="table table-bordered">';
        echo '<thead><tr><th>Artículo</th><th>Cantidad</th><th>Precio Unitario</th><th>Total</th></tr></thead>';
        echo '<tbody>';

        for ($i = 0; $i < count($articulos); $i++) {
            if (!empty($articulos[$i]) && !empty($cantidades[$i]) && !empty($precios[$i])) {
                $total_articulo = $cantidades[$i] * $precios[$i];
                $subtotal += $total_articulo;

                echo '<tr>';
                echo '<td>' . htmlspecialchars($articulos[$i]) . '</td>';
                echo '<td>' . htmlspecialchars($cantidades[$i]) . '</td>';
                echo '<td>$' . number_format($precios[$i], 2) . '</td>';
                echo '<td>$' . number_format($total_articulo, 2) . '</td>';
                echo '</tr>';
            }
        }

        $itbms = $subtotal * 0.07;
        $total = $subtotal + $itbms;

        echo '</tbody>';
        echo '</table>';

        echo '<div class="resultados">';
        echo '<p><strong>Subtotal: </strong>$' . number_format($subtotal, 2) . '</p>';
        echo '<p><strong>ITBMS (7%): </strong>$' . number_format($itbms, 2) . '</p>';
        echo '<h4><strong>Total a pagar: </strong>$' . number_format($total, 2) . '</h4>';
        echo '</div>';
    }
    ?>
    <div class="text-center mt-4">
        <a href="index.html" class="btn btn-secondary">Generar otra factura</a>
    </div>
</div>
</body>
</html>
