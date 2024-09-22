<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertidor de Monedas - Nobel De Gracia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Convertidor de Dólares</h1>
    <form action="" method="post">
        <input type="number" name="dolares" step="0.01" placeholder="Ingrese cantidad en dólares" required>
        <br>
        <button type="submit" name="convertir" value="eur">Convertir a Euros</button>
        <button type="submit" name="convertir" value="crc">Convertir a Colones</button>
        <button type="submit" name="convertir" value="mxn">Convertir a Pesos MX</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dolares = $_POST['dolares'];

        $tasa_eur = 0.84;
        $tasa_crc = 624.32;
        $tasa_mxn = 19.95;

        $conversion = 0;
        $moneda = "";

        if ($_POST['convertir'] == 'eur') {
            $conversion = $dolares * $tasa_eur;
            $moneda = "Euros";
        } elseif ($_POST['convertir'] == 'crc') {
            $conversion = $dolares * $tasa_crc;
            $moneda = "Colones";
        } elseif ($_POST['convertir'] == 'mxn') {
            $conversion = $dolares * $tasa_mxn;
            $moneda = "Pesos Mexicanos";
        }

        echo "<p><strong>$dolares</strong> dólares son <strong>" . number_format($conversion, 2) . "</strong> $moneda.</p>";
    }
    ?>
</div>

</body>
</html>
