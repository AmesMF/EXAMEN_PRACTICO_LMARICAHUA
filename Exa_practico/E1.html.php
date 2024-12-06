<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Tabla de Multiplicar</title>
</head>
<body>
    <h1>Generar Tabla de Multiplicar</h1>
    
    <form method="POST" action="">
        <label for="numero">Ingrese un número:</label>
        <input type="number" id="numero" name="numero" required>
        <button type="submit">Generar Tabla</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST['numero'];
        if (is_numeric($numero) && $numero > 0) {
            echo "<h2>Tabla de Multiplicar del $numero</h2>";
            echo "<table border='1' cellpadding='10'>
                    <tr>
                        <th>Multiplicación</th>
                        <th>Resultado</th>
                    </tr>";
            for ($i = 1; $i <= 12; $i++) {
                echo "<tr>
                        <td>$numero x $i</td>
                        <td>" . ($numero * $i) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color: red;'>Por favor, ingrese un número válido mayor que 0.</p>";
        }
    }
    ?>

</body>
</html>