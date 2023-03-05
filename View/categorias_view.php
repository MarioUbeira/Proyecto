<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <div class="contenedor_productos">
        <?php
        foreach ($array_categorias as $linea) {
            echo "<div class='producto'>" . $linea['Nombre'] . "</div>";
        }
        ?>
    </div>
</body>

</html>